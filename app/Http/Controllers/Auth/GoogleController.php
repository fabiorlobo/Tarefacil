<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GoogleController extends Controller
{
	public function redirectToGoogle()
	{
		return Socialite::driver('google')->redirect();
	}

	public function handleGoogleCallback()
	{
		try {
			$googleUser = Socialite::driver('google')->user();
			$user = User::where('email', $googleUser->getEmail())->first();

			if ($user) {
				$user->update([
					'avatar' => $googleUser->getAvatar(),
				]);
				Auth::login($user);
				return redirect()->intended('painel');
			} else {
				$newUser = User::create([
					'name' => $googleUser->getName(),
					'email' => $googleUser->getEmail(),
					'google_id' => $googleUser->getId(),
					'password' => Hash::make(\Illuminate\Support\Str::random(24)),
					'avatar' => $googleUser->getAvatar(),
				]);

				Auth::login($newUser);

				return redirect()->intended('painel');
			}
		} catch (\Exception $e) {
			return redirect()->route('entrar');
		}
	}
}