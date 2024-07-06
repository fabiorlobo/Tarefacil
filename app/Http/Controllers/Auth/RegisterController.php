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
		$this->validator($request->all())->validate();

		$user = $this->create($request->all());

		Auth::login($user);

		return redirect()->intended('painel');
	}

	protected function validator(array $data)
	{
		return Validator::make($data, [
			'name' => ['required', 'string', 'max:255'],
			'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
			'password' => ['required', 'string', 'min:8', 'confirmed'],
			'terms' => ['accepted'],
		]);
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
}