@extends('layouts.dashboard')

@section('title', 'Painel')

@section('content')
	<header class="heading">
		<h1 class="title title--section">Meu painel</h1>
		<div class="heading__text">
			<p>Olá, {{ Auth::user()->name }}!</p>
		</div>
	</header>

	<section class="main__section">
		<h2 class="title title--section">Seus projetos</h2>

		<div class="loop">
			@foreach($projetos as $projeto)
				<div class="loop__item">
					<h3 class="title title--small"><a href="{{ route('projetos.show', $projeto->id) }}">{{ $projeto->nome }}</a></h3>
					@if($projeto->descricao)
						<p>{{ $projeto->descricao }}</p>
					@endif
					<div class="loop__info">
						@if($projeto->listas->count() > 0)
							<span class="loop__info__data">
								{{ $projeto->listas->count() }} {{ $projeto->listas->count() === 1 ? 'lista' : 'listas' }}
							</span>
						@endif

						@php
							$tarefasPendentes = $projeto->tarefasPendentes->count();
						@endphp

						@if($projeto->tarefasPendentes->count() > 0)
							<span class="loop__info__data">
								{{ $projeto->tarefasPendentes->count() }} {{ $projeto->tarefasPendentes->count() === 1 ? 'tarefa pendente' : 'tarefas pendentes' }}
							</span>
						@endif
					</div>
				</div>
			@endforeach
		</div>
	</section>
@endsection