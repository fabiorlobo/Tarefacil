<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cookie;

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
		// Validação dos dados de entrada
		$validator = Validator::make($request->all(), [
			'email' => 'required|email',
			'password' => 'required|string|min:8',
		], $this->messages());

		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$credentials = $request->only('email', 'password');
		$remember = $request->has('remember');

		if (Auth::attempt($credentials, $remember)) {
			$request->session()->regenerate();

			if ($remember) {
				config(['session.lifetime' => 43200]);
			} else {
				config(['session.lifetime' => 1440]);
			}

			return redirect()->intended('painel');
		}

		return back()->withErrors([
			'email' => 'Os dados fornecidos não são válidos.',
		]);
	}

	protected function messages()
	{
		return [
			'email.required' => 'O campo email é obrigatório.',
			'email.email' => 'O campo email deve ser um endereço de email válido.',
			'password.required' => 'O campo senha é obrigatório.',
			'password.min' => 'A senha deve ter no mínimo 8 caracteres.',
		];
	}
}