@extends('layouts.dashboard')

@section('title', 'Criar Tarefa')

@section('content')
	<h2>Criar Tarefa</h2>
	@if (session('status'))
		<div class="alert alert-success">{{ session('status') }}</div>
	@endif
	<form method="POST" action="{{ route('tarefas.store') }}">
		@csrf
		<div>
			<label for="descricao">Descrição:</label>
			<textarea id="descricao" name="descricao" required>{{ old('descricao') }}</textarea>
			@error('descricao')
				<div class="error">{{ $message }}</div>
			@enderror
		</div>
		<div>
			<label for="lista_id">Lista:</label>
			<select id="lista_id" name="lista_id" class="select2">
				<option value="">Selecione uma lista</option>
				@foreach ($listas as $lista)
					<option value="{{ $lista->id }}" {{ isset($listaId) && $listaId == $lista->id ? 'selected' : '' }}>
						{{ $lista->nome }}</option>
				@endforeach
			</select>
			@error('lista_id')
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
			<label for="tempo_utilizado_horas">Tempo Utilizado (Horas):</label>
			<input type="text" id="tempo_utilizado_horas" name="tempo_utilizado_horas"
				value="{{ old('tempo_utilizado_horas') }}">
			@error('tempo_utilizado_horas')
				<div class="error">{{ $message }}</div>
			@enderror
		</div>
		<div>
			<label for="tempo_utilizado_minutos">Tempo Utilizado (Minutos):</label>
			<input type="text" id="tempo_utilizado_minutos" name="tempo_utilizado_minutos"
				value="{{ old('tempo_utilizado_minutos') }}">
			@error('tempo_utilizado_minutos')
				<div class="error">{{ $message }}</div>
			@enderror
		</div>
		<div>
			<button type="submit">Criar Tarefa</button>
		</div>
	</form>
@endsection

@push('scripts')
	<script>
		$(document).ready(function () {
			$('.select2').select2();
		});
	</script>
@endpush