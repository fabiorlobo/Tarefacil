@extends('layouts.dashboard')

@section('title', 'Criar lista')

@section('content')
	<header class="heading">
		@php
			$projetoSelecionado = $projetos->where('id', $projetoIdSelecionado)->first();
		@endphp

		<h1 class="title title--section title--small">
			@if ($projetoSelecionado)
				<a href="{{ route('projetos.show', $projetoSelecionado->id) }}">{{ $projetoSelecionado->nome }}</a> › 
			@endif
			Criar lista
		</h1>

		<div class="heading__text">
			<p>Preencha os dados abaixo para criar sua lista de tarefas:</p>
		</div>
	</header>

	@if (session('status'))
		<div class="alert alert--success">
			<?php \App\Helpers\SvgHelper::render(['name' => 'tasks', 'class' => 'center']); ?>
			<span class="alert__text">{{ session('status') }}</span>
		</div>
	@endif

	<section class="main__section">
		@include('includes.form-listas', [
			'action' => route('listas.store'),
			'isEdit' => false,
			'buttonText' => 'Criar lista'
		])
	</section>
@endsection