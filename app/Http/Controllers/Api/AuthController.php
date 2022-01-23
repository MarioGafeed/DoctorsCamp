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
use Illuminate\Validation\ValidationException;

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
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => 'These credentials do not match our records.',
            ]);
        }

        $token = $user->createToken($user->id.'-'.time());

        return response()->json([
            'message' => 'user logged successfully',
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
          'message' => 'user logged successfully',
          'access_token' => $token->plainTextToken,
          'user' => $user,
          'token_type' => 'Bearer',
      ]);
      // $token = $user->createToken('auth-token');
      // $plainToken = $token->plainTextToken;
      // return Response::json([
      //   'token'  => $plainToken
      // ]);
      // return new UserResource($user);
    }

    public function me()
    {
        return response()->json([
            'message' => 'user info retreived successfully',
            'user' => auth()->user(),
        ]);
    }

    public function verify()
    {
        return response()->json([
            'message' => 'token is valid',
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
            'message' => 'token refreshed successfully',
            'access_token' => $token->plainTextToken,
            'user' => $user,
            'token_type' => 'Bearer',
        ]);
    }

    public function logout()
    {
        auth()->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'logged out successfully',
        ]);
    }
}
