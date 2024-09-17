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
		$users = User::all();
		return view('painel.usuarios.index', compact('users'));
	}

	public function destroy($id)
	{
		$this->authorize('delete', User::class);
		$user = User::findOrFail($id);
		$user->delete();
		return redirect()->route('usuarios.index')->with('status', 'Usuário excluído com sucesso!');
	}
}