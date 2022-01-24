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

    

    public function logout()
    {
        auth()->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'logged out successfully',
        ]);
    }
}
