@extends('layouts.dashboard')

@section('title', 'Minha conta')

@section('content')
	<h2>Minha Conta</h2>
	@if (session('status'))
		<div>{{ session('status') }}</div>
	@endif
	<form method="POST" action="{{ url('/conta') }}">
		@csrf
		<div>
			<label for="name">Nome Completo:</label>
			<input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
		</div>
		<div>
			<label for="email">Email:</label>
			<input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
		</div>
		<div>
			<label for="password">Nova Senha (deixe em branco para manter a senha atual):</label>
			<input type="password" id="password" name="password">
		</div>
		<div>
			<label for="password_confirmation">Confirmar Nova Senha:</label>
			<input type="password" id="password_confirmation" name="password_confirmation">
		</div>
		<div>
			<button type="submit">Atualizar Conta</button>
		</div>
	</form>
@endsection