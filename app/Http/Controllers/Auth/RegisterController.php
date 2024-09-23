<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
	public function showRegistrationForm()
	{
		if (Auth::check()) {
			return redirect()->route('painel');
		}

		return view('cadastro');
	}

	public function register(Request $request)
	{
		$validator = $this->validator($request->all());

		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$data = $request->all();
		$data['email'] = filter_var($data['email'], FILTER_SANITIZE_EMAIL);

		$user = $this->create($data);

		Auth::login($user);

		return redirect()->intended('painel');
	}

	protected function validator(array $data)
	{
		return Validator::make($data, [
			'name' => ['required', 'string', 'min:3', 'max:255'],
			'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
			'password' => ['required', 'string', 'min:8', 'confirmed'],
			'terms' => ['accepted'],
		], $this->messages());
	}

	protected function create(array $data)
	{
		return User::create([
			'name' => $data['name'],
			'email' => $data['email'],
			'password' => Hash::make($data['password']),
			'avatar' => 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($data['email']))) . '?s=200&d=mm',
		]);
	}

	protected function messages()
	{
		return [
			'name.required' => 'O campo nome é obrigatório.',
			'name.min' => 'O nome deve ter no mínimo 3 caracteres.',
			'email.required' => 'O campo email é obrigatório.',
			'email.email' => 'O campo email deve ser um endereço de email válido.',
			'email.unique' => 'Esse endereço de e-mail já está cadastrado em nosso sistema.',
			'password.required' => 'O campo senha é obrigatório.',
			'password.min' => 'A senha deve ter no mínimo 8 caracteres.',
			'password.confirmed' => 'A confirmação da senha não confere.',
			'terms.accepted' => 'Você deve aceitar os termos de serviço e a política de privacidade.',
		];
	}
}