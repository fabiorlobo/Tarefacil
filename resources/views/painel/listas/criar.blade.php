@extends('layouts.dashboard')

@section('title', 'Criar Lista')

@section('content')
	<h2>Criar Lista</h2>
	@if (session('status'))
		<div class="alert alert-success">{{ session('status') }}</div>
	@endif
	<form method="POST" action="{{ route('listas.store') }}">
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
			<label for="projeto_id">Projeto:</label>
			<select id="projeto_id" name="projeto_id" class="select2" style="width: 100%;">
				<option value="">Selecione ou crie um projeto</option>
				@foreach ($projetos as $projeto)
					<option value="{{ $projeto->id }}" {{ old('projeto_id') == $projeto->id ? 'selected' : '' }}>
						{{ $projeto->nome }}
					</option>
				@endforeach
			</select>
			@error('projeto_id')
				<div class="error">{{ $message }}</div>
			@enderror
		</div>
		<div>
			<label for="tempo_previsto_horas">Tempo Previsto (Horas):</label>
			<input type="text" id="tempo_previsto_horas" name="tempo_previsto_horas" value="{{ old('tempo_previsto_horas') }}">
			@error('tempo_previsto_horas')
				<div class="error">{{ $message }}</div>
			@enderror
		</div>
		<div>
			<label for="tempo_previsto_minutos">Tempo Previsto (Minutos):</label>
			<input type="text" id="tempo_previsto_minutos" name="tempo_previsto_minutos"
				value="{{ old('tempo_previsto_minutos') }}">
			@error('tempo_previsto_minutos')
				<div class="error">{{ $message }}</div>
			@enderror
		</div>
		<div>
			<button type="submit">Criar Lista</button>
		</div>
	</form>
@endsection