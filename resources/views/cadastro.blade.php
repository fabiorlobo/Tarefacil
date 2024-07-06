@extends('layouts.website')

@section('title', 'Cadastro')

@section('content')
	<h2>Cadastro</h2>
	<form method="POST" action="{{ route('register') }}">
		@csrf
		<div>
			<label for="name">Nome Completo:</label>
			<input type="text" id="name" name="name" required>
		</div>
		<div>
			<label for="email">Email:</label>
			<input type="email" id="email" name="email" required>
		</div>
		<div>
			<label for="password">Senha:</label>
			<input type="password" id="password" name="password" required>
		</div>
		<div>
			<label for="password_confirmation">Confirmar Senha:</label>
			<input type="password" id="password_confirmation" name="password_confirmation" required>
		</div>
		<div>
			<input type="checkbox" id="terms" name="terms" required>
			<label for="terms">Concordo com os termos de serviço e política de privacidade</label>
		</div>
		<div>
			<button type="submit">Cadastrar</button>
		</div>
	</form>
	<a href="{{ url('auth/google') }}">Cadastrar com Google</a>
@endsection