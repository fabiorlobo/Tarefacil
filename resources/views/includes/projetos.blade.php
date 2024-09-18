@if($projetos->count() > 0)
	<section class="main__section main__section--separator">
		@if(Route::is('painel'))
			<h2 class="title title--section title--small">Seus projetos</h2>
		@endif

		<div class="loop">
			@foreach($projetos as $projeto)
				@if($projeto->user_id == auth()->id())
					<div class="loop__item box">
						<h3 class="title title--smaller"><a href="{{ route('projetos.show', $projeto->id) }}">{{ $projeto->nome }}</a></h3>
						@if($projeto->descricao)
							<div class="loop__item__description">
								<p>{{ $projeto->descricao }}</p>
							</div>
						@endif

						@php
							$listasCount = $projeto->listas->count();
							$tarefasPendentes = $projeto->tarefasPendentes->count();
						@endphp

						@if($listasCount > 0 || $tarefasPendentes > 0)
							<div class="loop__item__info">
								@if($listasCount > 0)
									<span class="loop__item__info__data">
										{{ $listasCount }} {{ $listasCount === 1 ? 'lista' : 'listas' }}
									</span>
								@endif

								@if($tarefasPendentes > 0)
									<span class="loop__item__info__data">
										{{ $tarefasPendentes }} {{ $tarefasPendentes === 1 ? 'tarefa pendente' : 'tarefas pendentes' }}
									</span>
								@endif
							</div>
						@endif
					</div>
				@endif
			@endforeach
		</div>
	</section>
@endif