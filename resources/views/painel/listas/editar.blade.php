@extends('layouts.dashboard')

@section('title', 'Editar lista')

@section('content')
	<header class="heading">
		<h1 class="title title--section title--small">
			@if (isset($lista->projeto) && $lista->projeto)
				<a href="{{ route('projetos.show', $lista->projeto->id) }}">{{ $lista->projeto->nome }}</a> › 
			@endif
			Editar lista
		</h1>

		<div class="heading__text">
			<p>Preencha os dados abaixo para editar sua lista de tarefas:</p>
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
			'action' => route('listas.update', $lista->id),
			'isEdit' => true,
			'buttonText' => 'Atualizar lista',
			'lista' => $lista,
			'projetoIdSelecionado' => old('projeto_id', $lista->projeto_id ?? '')
		])
	</section>
@endsection