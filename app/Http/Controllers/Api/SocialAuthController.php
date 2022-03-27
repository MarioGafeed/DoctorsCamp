<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LinkedSocialAccount;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\User as ProviderUser;

class SocialAuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'access_token' => ['required'],
            'provider' => ['required', 'in:google,facebook'],
            'country_id' => ['required', 'integer', 'exists:countries,id'],
        ]);

        $user = Socialite::driver($request->provider)->userFromToken($request->access_token);

        $user = $this->findOrCreate($user, $request->provider);

        return $this->createToken($user);
    }

    protected function findOrCreate(ProviderUser $providerUser, string $provider): User
    {
        $linkedSocialAccount = LinkedSocialAccount::whereProviderName($provider)->whereProviderId($providerUser->getId())->first();

        if ($linkedSocialAccount && $user = $linkedSocialAccount->user) {
            return $linkedSocialAccount->user;
        }

        if ($user = User::whereEmail($providerUser->getEmail())->first()) {
            return $user;
        }

        $user = User::create([
            'name' => $providerUser->getName(),
            'email' => $providerUser->getEmail(),
            'password' => Hash::make($providerUser->getId()),
            'country_id' => request()->get('country_id'),
        ])->fresh();

        $user->linkedSocialAccounts()->create([
            'provider_id' => $providerUser->getId(),
            'provider_name' => $provider,
        ]);

        return $user;
    }

    public function createToken(User $user)
    {
        $token = $user->createToken($user->id.'-'.time());

        return response()->json([
            'message' => 'user logged successfully',
            'access_token' => $token->plainTextToken,
            'user' => $user,
            'token_type' => 'Bearer',
        ]);
    }
}
