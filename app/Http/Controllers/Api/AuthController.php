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
use Illuminate\Support\Str;


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

    public function sendPasswordResetLinkEmail(Request $request)
    {
  		$request->validate(['email' => 'required|email']);

  		$status = Password::sendResetLink(
  			$request->only('email')
  		 );

  		if($status === Password::RESET_LINK_SENT) {
  			return response()->json(['message' => __($status)], 200);
  		}
       throw ValidationException::withMessages([
       'email' => __($status)
      ]);
	 }

    public function resetPassword(Request $request)
    {
      $request->validate([
  			'token' => 'required',
  			'email' => 'required|email',
  			'password' => 'required|confirmed',
  		]);

  		$status = Password::reset(
  			$request->only('email', 'password', 'password_confirmation', 'token'),
  			function ($user, $password) use ($request) {
  				$user->forceFill([
  					'password' => Hash::make($password)
  				])->setRememberToken(Str::random(60));

  				$user->save();

  				event(new PasswordReset($user));
  			}
  		);

  		if($status == Password::PASSWORD_RESET) {
  			return response()->json(['message' => __($status)], 200);
  		}
       throw ValidationException::withMessages([
        'email' => __($status)
        ]);
  	}

    public function changePassword(Request $request) {
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return response()->json([
                'message' => trans('main.passnotmatch'),
            ]);
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            // Current password and new password same
            return response()->json([
                'message' => trans('main.passcurrent'),
            ]);
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|confirmed',
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = Hash::make($request->get('new-password'));
        $user->save();

        return response()->json([
            'message' => trans('main.passchange'),
        ]);
    }

    public function logout()
    {
        auth()->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => trans('main.logoutsuccess')
        ]);
    }
}
