@extends('layouts.website')

@section('title', 'Entrar')

@section('content')
	<h2>Entrar</h2>
	<form method="POST" action="{{ route('login') }}">
		@csrf
		<div>
			<label for="email">Email:</label>
			<input type="email" id="email" name="email" required>
		</div>
		<div>
			<label for="password">Senha:</label>
			<input type="password" id="password" name="password" required>
		</div>
		<div>
			<button type="submit">Entrar</button>
		</div>
	</form>
	<a href="{{ url('auth/google') }}">Entrar com Google</a>
@endsection