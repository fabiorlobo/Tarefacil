@extends('layouts.dashboard')

@section('title', 'Criar Projeto')

@section('content')
	<h2>Criar Projeto</h2>
	@if (session('status'))
		<div class="alert alert-success">{{ session('status') }}</div>
	@endif
	<form method="POST" action="{{ route('projetos.store') }}">
		@csrf
		<div>
			<label for="nome">Nome:</label>
			<input type="text" id="nome" name="nome" value="{{ old('nome') }}" required>
			@error('nome')
				<div class="error">{{ $message }}</div>
			@enderror
		</div>
		<div>
			<label for="descricao">Descrição:</label>
			<textarea id="descricao" name="descricao">{{ old('descricao') }}</textarea>
			@error('descricao')
				<div class="error">{{ $message }}</div>
			@enderror
		</div>
		<div>
			<button type="submit">Criar Projeto</button>
		</div>
	</form>
@endsection