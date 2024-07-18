@extends('layouts.dashboard')

@section('title', 'Editar Lista')

@section('content')
	<h2>Editar Lista</h2>
	<form method="POST" action="{{ route('listas.update', $lista->id) }}">
		@csrf
		@method('PUT')
		<div>
			<label for="nome">Nome:</label>
			<input type="text" id="nome" name="nome" value="{{ old('nome', $lista->nome) }}" required>
			@error('nome')
				<div class="error">{{ $message }}</div>
			@enderror
		</div>
		<div>
			<label for="descricao">Descrição:</label>
			<textarea id="descricao" name="descricao">{{ old('descricao', $lista->descricao) }}</textarea>
			@error('descricao')
				<div class="error">{{ $message }}</div>
			@enderror
		</div>
		<div>
			<label for="projeto_id">Projeto:</label>
			<select id="projeto_id" name="projeto_id">
				<option value="">Selecione um projeto</option>
				<!-- Loop through projects here -->
			</select>
			@error('projeto_id')
				<div class="error">{{ $message }}</div>
			@enderror
		</div>
		<div>
			<label for="tempo_previsto_horas">Tempo Previsto (Horas):</label>
			<input type="text" id="tempo_previsto_horas" name="tempo_previsto_horas"
				value="{{ old('tempo_previsto_horas', $lista->tempo_previsto_horas) }}">
			@error('tempo_previsto_horas')
				<div class="error">{{ $message }}</div>
			@enderror
		</div>
		<div>
			<label for="tempo_previsto_minutos">Tempo Previsto (Minutos):</label>
			<input type="text" id="tempo_previsto_minutos" name="tempo_previsto_minutos"
				value="{{ old('tempo_previsto_minutos', $lista->tempo_previsto_minutos) }}">
			@error('tempo_previsto_minutos')
				<div class="error">{{ $message }}</div>
			@enderror
		</div>
		<div>
			<button type="submit">Atualizar Lista</button>
		</div>
	</form>
@endsection