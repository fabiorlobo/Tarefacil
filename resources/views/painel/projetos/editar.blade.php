@extends('layouts.dashboard')

@section('title', 'Editar Projeto')

@section('content')
	<h2>Editar Projeto</h2>
	@if (session('status'))
		<div class="alert alert-success">{{ session('status') }}</div>
	@endif
	<form method="POST" action="{{ route('projetos.update', $projeto->id) }}">
		@csrf
		@method('PUT')
		<div>
			<label for="nome">Nome:</label>
			<input type="text" id="nome" name="nome" value="{{ old('nome', $projeto->nome) }}" required>
			@error('nome')
				<div class="error">{{ $message }}</div>
			@enderror
		</div>
		<div>
			<label for="descricao">Descrição:</label>
			<textarea id="descricao" name="descricao">{{ old('descricao', $projeto->descricao) }}</textarea>
			@error('descricao')
				<div class="error">{{ $message }}</div>
			@enderror
		</div>
		<div>
			<button type="submit">Atualizar Projeto</button>
		</div>
	</form>
@endsection