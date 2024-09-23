@extends('layouts.dashboard')

@section('title', $nota->nome)

@section('content')
	<header class="heading">
		<h1 class="title title--section title--small">
			@if (isset($nota->projeto) && $nota->projeto)
				<a href="{{ route('projetos.show', $nota->projeto->id) }}">{{ $nota->projeto->nome }}</a> › 
			@endif
			Editar anotação
		</h1>

		@if ($nota->descricao)
			<div class="heading__text">
				<p>{{ $nota->descricao }}</p>
			</div>
		@endif

		<div class="actions">
			<a class="actions__button" href="{{ route('notas.edit', $nota->id) }}">
				<?php \App\Helpers\SvgHelper::render(['name' => 'edit', 'class' => 'center']); ?>
				<span class="actions__button__text">Editar</span>
			</a>
		</div>
	</header>

	<section class="main__section">
		<div class="quill-result box">
			{!! $nota->nota !!}
		</div>
	</section>
@endsection