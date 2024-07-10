@extends('layouts.website')

@section('title', 'Cadastro')

@section('content')
	<h2>Cadastro</h2>
	<form method="POST" action="{{ route('register') }}">
		@csrf
		<div>
			<label for="name">Nome Completo:</label>
			<input type="text" id="name" name="name" required value="{{ old('name') }}">
			@error('name')
				<div class="error">{{ $message }}</div>
			@enderror
		</div>
		<div>
			<label for="email">Email:</label>
			<input type="email" id="email" name="email" required value="{{ old('email') }}">
			@error('email')
				<div class="error">{{ $message }}</div>
			@enderror
		</div>
		<div>
			<label for="password">Senha:</label>
			<input type="password" id="password" name="password" required>
			@error('password')
				<div class="error">{{ $message }}</div>
			@enderror
		</div>
		<div>
			<label for="password_confirmation">Confirmar Senha:</label>
			<input type="password" id="password_confirmation" name="password_confirmation" required>
			@error('password_confirmation')
				<div class="error">{{ $message }}</div>
			@enderror
		</div>
		<div>
			<input type="checkbox" id="terms" name="terms" required>
			<label for="terms">Concordo com os termos de serviço e política de privacidade</label>
			@error('terms')
				<div class="error">{{ $message }}</div>
			@enderror
		</div>
		<div>
			<button type="submit">Cadastrar</button>
		</div>
	</form>
	<a href="{{ url('auth/google') }}">Cadastrar com Google</a>
@endsection