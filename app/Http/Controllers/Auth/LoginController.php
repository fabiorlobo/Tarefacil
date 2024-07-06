<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
	public function showLoginForm()
	{
		if (Auth::check()) {
			return redirect()->route('painel');
		}

		return view('entrar');
	}

	public function login(Request $request)
	{
		$credentials = $request->only('email', 'password');

		if (Auth::attempt($credentials)) {
			$request->session()->regenerate();
			return redirect()->intended('painel');
		}

		return back()->withErrors([
			'email' => 'As credenciais fornecidas não são válidas.',
		]);
	}
}