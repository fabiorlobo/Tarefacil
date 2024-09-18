@if($listas->count() > 0)
	<section class="main__section main__section--separator">
		<h2 class="title title--section title--small">Suas listas de tarefas</h2>

		<div class="loop">
			@foreach($listas as $lista)
				@if($lista->user_id == auth()->id())
					<div class="loop__item box">
						<h3 class="title title--smaller"><a href="{{ route('listas.show', $lista->id) }}">{{ $lista->nome }}</a></h3>
						@if($lista->descricao)
							<div class="loop__item__description">
								<p>{{ $lista->descricao }}</p>
							</div>
						@endif
						<div class="loop__item__info">
							@php
								$tempoUtilizadoHoras = $lista->tarefas->sum('tempo_utilizado_horas');
								$tempoUtilizadoMinutos = $lista->tarefas->sum('tempo_utilizado_minutos');
								$tempoPrevistoHoras = $lista->tempo_previsto_horas ?? 0;
								$tempoPrevistoMinutos = $lista->tempo_previsto_minutos ?? 0;
								
								$totalUtilizadoMinutos = $tempoUtilizadoHoras * 60 + $tempoUtilizadoMinutos;
								$totalPrevistoMinutos = $tempoPrevistoHoras * 60 + $tempoPrevistoMinutos;
								$tempoRestanteMinutos = $totalPrevistoMinutos - $totalUtilizadoMinutos;

								$tarefasPendentes = $lista->tarefas->where('status', false)->count();
							@endphp

							@if($totalUtilizadoMinutos > 0)
								<span class="loop__item__info__data">{{ intdiv($totalUtilizadoMinutos, 60) }} horas e {{ $totalUtilizadoMinutos % 60 }} minutos de trabalho</span>
							@endif

							@if($totalPrevistoMinutos > 0 && $tempoRestanteMinutos > 0)
								<span class="loop__item__info__data">(restam {{ intdiv($tempoRestanteMinutos, 60) }} horas e {{ $tempoRestanteMinutos % 60 }} minutos)</span>
							@endif

							@if($tarefasPendentes > 0)
								<span class="loop__item__info__data">{{ $tarefasPendentes }} {{ $tarefasPendentes === 1 ? 'tarefa pendente' : 'tarefas pendentes' }}</span>
							@endif
						</div>
					</div>
				@endif
			@endforeach
		</div>
	</section>
@endif