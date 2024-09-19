@extends('layouts.dashboard')

@section('title', $lista->nome)

@section('content')
	<header class="heading">
		<h1 class="title title--section title--small" data-lista-id="{{ $lista->id }}">
			@if (isset($lista->projeto) && $lista->projeto)
				<a href="{{ route('projetos.show', $lista->projeto->id) }}">{{ $lista->projeto->nome }}</a> › 
			@endif
			{{ $lista->nome }}
		</h1>

		@if ($lista->descricao)
			<div class="heading__text">
				<p>{{ $lista->descricao }}</p>

				@if($lista->tempo_previsto_horas || $lista->tempo_previsto_minutos)
					<span class="heading__time">Tempo reservado: {{ $lista->tempo_previsto_horas ?? 0 }} hora{{ $lista->tempo_previsto_horas != 1 ? 's' : '' }} e {{ $lista->tempo_previsto_minutos ?? 0 }} minuto{{ $lista->tempo_previsto_minutos != 1 ? 's' : '' }}.</span>
				@endif
			</div>
		@endif

		<div class="actions">
			<a class="actions__button" href="{{ route('listas.edit', $lista->id) }}">
				<?php \App\Helpers\SvgHelper::render(['name' => 'edit', 'class' => 'center']); ?>
				<span class="actions__button__text">Editar</span>
			</a>
			<a class="actions__button" href="{{ route('tarefas.create', $lista->id) }}">
				<?php \App\Helpers\SvgHelper::render(['name' => 'more', 'class' => 'center']); ?>
				<span class="actions__button__text">Nova tarefa</span>
			</a>
		</div>
	</header>

	@if (session('status'))
		<div class="alert alert--success">
			<?php \App\Helpers\SvgHelper::render(['name' => 'tasks', 'class' => 'center']); ?>
			<span class="alert__text">{{ session('status') }}</span>
		</div>
	@endif
	
	<section class="main__section main__section--separator">
		<div class="loop">
			@foreach ($lista->tarefas as $tarefa)
				<div class="loop__item loop__item--task box">
					<input class="loop__item__checkbox" type="checkbox" id="tarefa-{{ $tarefa->id }}" {{ $tarefa->status ? 'checked' : '' }} onchange="concluirTarefa({{ $tarefa->id }})">

					<div class="loop__item__description">
						<p>{{ $tarefa->descricao }}</p>
					</div>

					<div class="loop__item__info">
						<span class="loop__item__info__data">
							Tempo utilizado: <span id="timer-{{ $tarefa->id }}">{{ $tarefa->tempo_utilizado_horas ?? 0 }}h {{ $tarefa->tempo_utilizado_minutos ?? 0 }}m</span>
						</span>

						@if ($tarefa->tempo_previsto_horas || $tarefa->tempo_previsto_minutos)
							<span class="loop__item__info__data">
								Tempo previsto: {{ $tarefa->tempo_previsto_horas ?? 0 }}h {{ $tarefa->tempo_previsto_minutos ?? 0 }}m
							</span>
						@endif
					</div>

					<div class="actions">
						<a class="actions__button" href="{{ route('tarefas.edit', $tarefa->id) }}">
							<?php \App\Helpers\SvgHelper::render(['name' => 'edit', 'class' => 'center']); ?>
							<span class="actions__button__text">Editar</span>
						</a>

						<button class="actions__button" id="start-btn-{{ $tarefa->id }}" onclick="startTracker({{ $tarefa->id }})" {{ $tarefa->in_progress ? 'style=display:none' : '' }}>
							<?php \App\Helpers\SvgHelper::render(['name' => 'play', 'class' => 'center']); ?>
							<span class="actions__button__text">Iniciar</span>
						</button>

						<button class="actions__button actions__button--delete" id="stop-btn-{{ $tarefa->id }}" onclick="stopTracker({{ $tarefa->id }})" {{ !$tarefa->in_progress ? 'style=display:none' : '' }}>
							<?php \App\Helpers\SvgHelper::render(['name' => 'pause', 'class' => 'center']); ?>
							<span class="actions__button__text">Parar</span>
						</button>
					</div>
				</div>
			@endforeach
		</div>
	</section>

	@php
		$tempoTrabalhadoHoras = $lista->tarefas->sum('tempo_utilizado_horas');
		$tempoTrabalhadoMinutos = $lista->tarefas->sum('tempo_utilizado_minutos');

		$totalTrabalhadoMinutos = $tempoTrabalhadoHoras * 60 + $tempoTrabalhadoMinutos;
		$totalPrevistoMinutos = ($lista->tempo_previsto_horas ?? 0) * 60 + ($lista->tempo_previsto_minutos ?? 0);
		$tempoRestanteMinutos = $totalPrevistoMinutos - $totalTrabalhadoMinutos;

		$tempoExcedidoMinutos = $totalTrabalhadoMinutos > $totalPrevistoMinutos ? $totalTrabalhadoMinutos - $totalPrevistoMinutos : 0;

		$totalTarefas = $lista->tarefas->count();
		$tarefasConcluidas = $lista->tarefas->where('status', true)->count();
		$tarefasPendentes = $totalTarefas - $tarefasConcluidas;
	@endphp

	@if(($lista->tempo_previsto_horas || $lista->tempo_previsto_minutos) || $totalTrabalhadoMinutos > 0 || $totalTarefas > 0)
		<section class="main__section main__section--separator">
			<h2 class="title title--section title--small">Resumo</h2>

			<div class="box box--summary">
				@if($lista->tempo_previsto_horas || $lista->tempo_previsto_minutos)
					<div class="box__item">
						<b class="title title--smaller">Tempo reservado:</b>
						<span class="tempo-reservado">{{ $lista->tempo_previsto_horas ?? 0 }} hora{{ $lista->tempo_previsto_horas != 1 ? 's' : '' }} e {{ $lista->tempo_previsto_minutos ?? 0 }} minuto{{ $lista->tempo_previsto_minutos != 1 ? 's' : '' }}</span>
					</div>
				@endif

				@if($totalTrabalhadoMinutos > 0)
					<div class="box__item">
						<b class="title title--smaller">Tempo trabalhado:</b>
						<span class="tempo-trabalhado">{{ intdiv($totalTrabalhadoMinutos, 60) }} hora{{ intdiv($totalTrabalhadoMinutos, 60) != 1 ? 's' : '' }} e {{ $totalTrabalhadoMinutos % 60 }} minuto{{ $totalTrabalhadoMinutos % 60 != 1 ? 's' : '' }}</span>
					</div>
				@endif

				@if($totalPrevistoMinutos > 0 && $tempoRestanteMinutos > 0)
					<div class="box__item">
						<b class="title title--smaller">Tempo restante:</b>
						<span class="tempo-restante">{{ intdiv($tempoRestanteMinutos, 60) }} hora{{ intdiv($tempoRestanteMinutos, 60) != 1 ? 's' : '' }} e {{ $tempoRestanteMinutos % 60 }} minuto{{ $tempoRestanteMinutos % 60 != 1 ? 's' : '' }}</span>
					</div>
				@endif

				@if($tempoExcedidoMinutos > 0)
					<div class="box__item">
						<b class="title title--smaller">Tempo excedido:</b>
						<span class="tempo-excedido">{{ intdiv($tempoExcedidoMinutos, 60) }} hora{{ intdiv($tempoExcedidoMinutos, 60) != 1 ? 's' : '' }} e {{ $tempoExcedidoMinutos % 60 }} minuto{{ $tempoExcedidoMinutos % 60 != 1 ? 's' : '' }}</span>
					</div>
				@endif

				@if($totalTarefas > 0)
					<div class="box__item">
						<b class="title title--smaller">Total de tarefas:</b>
						<span class="total-tarefas">{{ $totalTarefas }} ({{ $tarefasConcluidas }} concluída{{ $tarefasConcluidas != 1 ? 's' : '' }}, {{ $tarefasPendentes }} pendente{{ $tarefasPendentes != 1 ? 's' : '' }})</span>
					</div>
				@endif
			</div>

			<div class="actions">
				<a class="actions__button" href="{{ route('listas.downloadReport', $lista->id) }}">
					<?php \App\Helpers\SvgHelper::render(['name' => 'download', 'class' => 'center']); ?>
					<span class="actions__button__text">Relatório</span>
				</a>
			</div>
		</section>
	@endif

@endsection

@push('scripts')
	<script src="{{ asset('assets/scripts/time_tracker.js') }}"></script>
	<script src="{{ asset('assets/scripts/list_summary.js') }}"></script>
@endpush