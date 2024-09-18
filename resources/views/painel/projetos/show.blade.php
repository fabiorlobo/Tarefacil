@extends('layouts.dashboard')

@section('title', $projeto->nome)

@section('content')
	<header class="heading">
		<h1 class="title title--section title--small">{{ $projeto->nome }}</h1>

		@if ($projeto->descricao)
			<div class="heading__text">
				<p>{{ $projeto->descricao }}</p>
			</div>
		@endif

		<div class="actions">
			<a class="actions__button" href="{{ route('projetos.edit', $projeto->id) }}">
				<?php \App\Helpers\SvgHelper::render(['name' => 'edit', 'class' => 'center']); ?>
				<span class="actions__button__text">Editar</span>
			</a>
			<a class="actions__button" href="{{ route('listas.create', ['projeto_id' => $projeto->id]) }}">
				<?php \App\Helpers\SvgHelper::render(['name' => 'more', 'class' => 'center']); ?>
				<span class="actions__button__text">Nova lista</span>
			</a>
		</div>
	</header>

	@if (session('status'))
		<div class="alert alert--success">
			<?php \App\Helpers\SvgHelper::render(['name' => 'tasks', 'class' => 'center']); ?>
			<span class="alert__text">{{ session('status') }}</span>
		</div>
	@endif

	@include('includes.listas', ['listas' => $projeto->listas])
@endsection