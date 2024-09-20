<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserController extends Controller
{
	use AuthorizesRequests;

	public function index()
	{
		$this->authorize('viewAny', User::class);
		$users = User::with(['projetos', 'listas'])->get();
		return view('painel.usuarios.index', compact('users'));
	}

	public function edit($id)
	{
		$this->authorize('update', User::class);
		$user = User::findOrFail($id);
		return view('painel.usuarios.editar', compact('user'));
	}

	public function update(Request $request, $id)
	{
		$this->authorize('update', User::class);
		$user = User::findOrFail($id);

		$request->validate([
			'name' => 'required|string|max:255',
			'email' => 'required|email|max:255',
			'password' => 'nullable|string|min:8|confirmed',
		]);

		$user->name = $request->input('name');
		$user->email = $request->input('email');

		if ($request->filled('password')) {
			$user->password = bcrypt($request->input('password'));
		}

		$user->save();

		return redirect()->route('usuarios.index')->with('status', 'Usuário atualizado com sucesso!');
	}

	public function destroy($id)
	{
		$this->authorize('delete', User::class);
		$user = User::findOrFail($id);
		$user->delete();
		return redirect()->route('usuarios.index')->with('status', 'Usuário excluído com sucesso!');
	}
}