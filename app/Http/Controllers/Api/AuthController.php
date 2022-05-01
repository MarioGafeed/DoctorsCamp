<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Interfaces\UserInterface;
use App\Http\Requests\UsersRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Mail\ResetPassword;
use Illuminate\Http\JsonResponse;


class AuthController extends Controller
{

    public function __construct(private UserInterface $userInterface)
    {
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'max:255', 'email'],
            'password' => ['required', 'string', 'max:50', 'min:6'],
            'email' => ['required', 'string', 'max:255', 'email'],
            'password' => ['required', 'string', 'max:50'],
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => trans('main.emailfail')
            ]);
        }

        $token = $user->createToken($user->id.'-'.time());

        return response()->json([
            'message' => trans('main.loginsuccess'),
            'access_token' => $token->plainTextToken,
            'user' => $user,
            'token_type' => 'Bearer',
        ]);
    }


    public function register(UsersRequest $request)
    {
      $user = $this->userInterface->store($request->all());

      $token = $user->createToken($user->id.'-'.time());

      return response()->json([
          'message' => trans('main.register'),
          'access_token' => $token->plainTextToken,
          'user' => $user,
          'token_type' => 'Bearer',
      ]);
    }

    public function me()
    {
        return response()->json([
            'message' => trans('main.userinfo'),
            'user' => auth()->user(),
        ]);
    }

    public function verify()
    {
        return response()->json([
            'message' => trans('main.tokenvalid'),
            'valid' => true,
        ]);
    }

    public function refresh()
    {
        $user = auth()->user();

        $tokenName = $user->currentAccessToken()->name;

        // remove all user tokens for the same source
        $user->currentAccessToken()->delete();

        $token = $user->createToken($tokenName);

        return response()->json([
            'message' => trans('main.tokenrefresh'),
            'access_token' => $token->plainTextToken,
            'user' => $user,
            'token_type' => 'Bearer',
        ]);
    }

    public function forgotPassword(Request $request)
    {
          $validator = Validator::make($request->all(), [
              'email' => ['required', 'string', 'email', 'max:255'],
          ]);

          if ($validator->fails()) {
              return new JsonResponse(['success' => false, 'message' => $validator->errors()], 422);
          }

          $verify = User::where('email', $request->all()['email'])->exists();

          if ($verify) {
              $verify2 =  DB::table('password_resets')->where([
                  ['email', $request->all()['email']]
              ]);

              if ($verify2->exists()) {
                  $verify2->delete();
              }

              $token = random_int(100000, 999999);
              $password_reset = DB::table('password_resets')->insert([
                  'email' => $request->all()['email'],
                  'token' =>  $token,
                  'created_at' => Carbon::now()
              ]);

              if ($password_reset) {
                  Mail::to($request->all()['email'])->send(new ResetPassword($token));

                  return new JsonResponse(
                      [
                          'success' => true,
                          'message' => "Please check your email for a 6 digit pin"
                      ],
                      200
                  );
              }
          } else {
              return new JsonResponse(
                  [
                      'success' => false,
                      'message' => "This email does not exist"
                  ],
                  400
              );
          }
    }

    public function verifyPin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
            'token' => ['required'],
        ]);

        if ($validator->fails()) {
            return new JsonResponse(['success' => false, 'message' => $validator->errors()], 422);
        }

        $check = DB::table('password_resets')->where([
            ['email', $request->all()['email']],
            ['token', $request->all()['token']],
        ]);

        if ($check->exists()) {
            $difference = Carbon::now()->diffInSeconds($check->first()->created_at);
            if ($difference > 3600) {
                return new JsonResponse(['success' => false, 'message' => "Token Expired"], 400);
            }

            $delete = DB::table('password_resets')->where([
                ['email', $request->all()['email']],
                ['token', $request->all()['token']],
            ])->delete();

            return new JsonResponse(
                [
                    'success' => true,
                    'message' => "You can now reset your password"
                ],
                200
                );
        } else {
            return new JsonResponse(
                [
                    'success' => false,
                    'message' => "Invalid token"
                ],
                401
            );
        }
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
          'email' => ['required', 'string', 'email', 'max:255'],
          'password' => ['required', 'string', 'confirmed'],
      ]);

      if ($validator->fails()) {
          return new JsonResponse(['success' => false, 'message' => $validator->errors()], 422);
      }

      $user = User::where('email',$request->email);
      $user->update([
          'password'=>Hash::make($request->password)
      ]);

      $token = $user->first()->createToken('myapptoken')->plainTextToken;

      return new JsonResponse(
          [
              'success' => true,
              'message' => "Your password has been reset",
              'token'=>$token
          ],
          200
      );
  	}

    // public function changePassword(Request $request) {
    //
    //     $user = $request->user();
    //
    //     if (!(Hash::check($request->get('current-password'), $user->password))) {
    //         // The passwords matches
    //         return response()->json([
    //             'message' => trans('main.passnotmatch'),
    //         ]);
    //     }
    //
    //     if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
    //         // Current password and new password same
    //         return response()->json([
    //             'message' => trans('main.passcurrent'),
    //         ]);
    //     }
    //
    //     $validatedData = $request->validate([
    //         'current-password' => 'required',
    //         'new-password' => 'required|confirmed',
    //     ]);
    //
    //     //Change Password
    //     $user->password = Hash::make($request->get('new-password'));
    //     $user->save();
    //
    //     return response()->json([
    //         'message' => trans('main.passchange'),
    //     ]);
    // }

    public function logout()
    {
        auth()->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => trans('main.logoutsuccess')
        ]);
    }
}
