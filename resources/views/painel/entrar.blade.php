@extends('layouts.website')

@section('title', 'Entrar')

@section('content')
	<h2>Entrar</h2>
	@if ($errors->any())
		<div class="errors">
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif
	<form method="POST" action="{{ route('login') }}">
		@csrf
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
			<input type="checkbox" id="remember" name="remember">
			<label for="remember">Lembrar-me</label>
		</div>
		<div>
			<button type="submit">Entrar</button>
		</div>
	</form>
	<a href="{{ url('auth/google') }}">Entrar com Google</a>
@endsection