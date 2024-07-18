@extends('layouts.dashboard')

@section('title', 'Detalhes da Lista')

@section('content')
	<h2>{{ $lista->nome }}</h2>
	<p>{{ $lista->descricao }}</p>

	@if (session('status'))
		<div class="alert alert-success">{{ session('status') }}</div>
	@endif

	<h3>Tarefas</h3>
	<a href="{{ route('tarefas.create', $lista->id) }}">Criar Nova Tarefa</a>
	<ul>
		@foreach ($lista->tarefas as $tarefa)
			<li>
				{{ $tarefa->descricao }} <br>
				@if ($tarefa->tempo_previsto_horas || $tarefa->tempo_previsto_minutos)
					[Tempo previsto:
					@if ($tarefa->tempo_previsto_horas)
						{{ $tarefa->tempo_previsto_horas }}h
					@endif
					@if ($tarefa->tempo_previsto_minutos)
						{{ $tarefa->tempo_previsto_minutos }}m
					@endif
					]
				@endif
				@if ($tarefa->tempo_utilizado_horas || $tarefa->tempo_utilizado_minutos)
					[Tempo utilizado:
					@if ($tarefa->tempo_utilizado_horas)
						{{ $tarefa->tempo_utilizado_horas }}h
					@endif
					@if ($tarefa->tempo_utilizado_minutos)
						{{ $tarefa->tempo_utilizado_minutos }}m
					@endif
					<span id="timer-{{ $tarefa->id }}"></span>
					]
				@endif
				<br>
				<button id="start-btn-{{ $tarefa->id }}" onclick="startTracker({{ $tarefa->id }})" {{ $tarefa->in_progress ? 'style=display:none' : '' }}>Iniciar</button>
				<button id="stop-btn-{{ $tarefa->id }}" onclick="stopTracker({{ $tarefa->id }})" {{ !$tarefa->in_progress ? 'style=display:none' : '' }}>Parar</button>
				<a href="{{ route('tarefas.edit', $tarefa->id) }}">Editar</a>
				<form method="POST" action="{{ route('tarefas.destroy', $tarefa->id) }}" style="display:inline;">
					@csrf
					@method('DELETE')
					<button type="submit" onclick="return confirm('Tem certeza que deseja excluir esta tarefa?')">Excluir</button>
				</form>
			</li>
		@endforeach
	</ul>
@endsection

@push('scripts')
	<script src="{{ asset('assets/scripts/time_tracker.js') }}"></script>
@endpush