<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
	public function show()
	{
		$user = Auth::user();
		return view('conta', compact('user'));
	}

	public function update(Request $request)
	{
		$user = Auth::user();

		$request->validate([
			'name' => ['required', 'string', 'max:255'],
			'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
			'password' => ['nullable', 'string', 'min:8', 'confirmed'],
		]);

		$user->name = $request->name;
		$user->email = $request->email;

		if ($request->filled('password')) {
			$user->password = Hash::make($request->password);
		}

		$user->save();

		return redirect()->route('account.show')->with('status', 'Conta atualizada com sucesso.');
	}
}