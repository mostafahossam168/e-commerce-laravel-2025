<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    public function callback($provider)
    {
        $socialUser = Socialite::driver($provider)->user();
        // dd($socialUser);
        $user = User::where([
            'provider' => $provider,
            'Provider_id' => $socialUser->id
        ])->first();

        if (!empty($user) && !$user?->status->value) {
            return $this->returnError('لايمكنك تسجيل الدخول برجاء التواصل مع اداره الموقع');
        }

        if (!$user) {
            $user = User::create([
                'name' => $socialUser->getName(),
                'email' => $socialUser->getEmail(),
                'password' => Hash::make('12345678'),
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
                'provider_token' => $socialUser->token,
                'type' => 'user',
                'email_verified_at' => now()
            ]);
        }
        Auth::login($user);
        $data = [
            'user' => new UserResource($user),
            'token' =>  $user->createToken('MyApp')->plainTextToken
        ];
        return $this->returnData($data, 'تم تسجيل الدخول  بنجاح');
    }
}