<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'max:255', 'email'],
            'password' => ['required', 'string', 'max:50'],
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
      // Mine
      // if($status == Password::PASSWORD_RESET) {
  		// 	return response()->json(['message' => __($status)], 200);
  		// } else {
  		// 	throw ValidationException::withMessages([
  		// 		'email' => __($status)
  		// 	]);
  		// }
  	}

=======
>>>>>>> Stashed changes
    public function logout()
    {
        auth()->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'logged out successfully',
        ]);
    }
}
