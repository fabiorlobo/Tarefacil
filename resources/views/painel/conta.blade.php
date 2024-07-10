@extends('layouts.dashboard')

@section('title', 'Minha Conta')

@section('content')
	<h2>Minha Conta</h2>
	@if (session('status'))
		<div>{{ session('status') }}</div>
	@endif
	@if ($errors->any())
		<div class="errors">
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif
	<form method="POST" action="{{ route('account.update') }}">
		@csrf
		<div>
			<label for="name">Nome Completo:</label>
			<input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
			@error('name')
				<div class="error">{{ $message }}</div>
			@enderror
		</div>
		<div>
			<label for="email">Email:</label>
			<input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
			@error('email')
				<div class="error">{{ $message }}</div>
			@enderror
		</div>
		<div>
			<label for="password">Nova Senha (deixe em branco para manter a senha atual):</label>
			<input type="password" id="password" name="password">
			@error('password')
				<div class="error">{{ $message }}</div>
			@enderror
		</div>
		<div>
			<label for="password_confirmation">Confirmar Nova Senha:</label>
			<input type="password" id="password_confirmation" name="password_confirmation">
			@error('password_confirmation')
				<div class="error">{{ $message }}</div>
			@enderror
		</div>
		<div>
			<button type="submit">Atualizar Conta</button>
		</div>
	</form>
	<form method="POST" action="{{ route('account.destroy') }}"
		onsubmit="return confirm('Tem certeza que deseja excluir sua conta? Esta ação não pode ser desfeita.');">
		@csrf
		<button type="submit">Excluir Conta</button>
	</form>
@endsection