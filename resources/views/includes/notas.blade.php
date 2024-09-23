@if($notas->count() > 0)
	<section class="main__section main__section--separator">
		@if(Route::is('painel') || Route::is('projetos.show'))
			<h2 class="title title--section title--small">Suas anotações</h2>
		@endif

		<div class="loop">
			@foreach ($notas as $nota)
				<div class="loop__item box">
					<h3 class="title title--smaller">
						<a href="{{ route('notas.show', $nota->id) }}">{{ $nota->nome }}</a>
					</h3>
					@if($nota->descricao)
						<div class="loop__item__description">
							<p>{{ $nota->descricao }}</p>
						</div>
					@endif
				</div>
			@endforeach
		</div>
	</section>
@endif