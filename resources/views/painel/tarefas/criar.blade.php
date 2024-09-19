@extends('layouts.dashboard')

@section('title', 'Criar tarefa')

@section('content')
	<header class="heading">
		<h1 class="title title--section title--small">Criar tarefa</h1>

		<div class="heading__text">
			<p>Preencha os dados abaixo para criar sua tarefa:</p>
		</div>
	</header>

	@if (session('status'))
		<div class="alert alert--success">
			<?php \App\Helpers\SvgHelper::render(['name' => 'tasks', 'class' => 'center']); ?>
			<span class="alert__text">{{ session('status') }}</span>
		</div>
	@endif

	<section class="main__section">
		@include('includes.form-tarefas', [
			'action' => route('tarefas.store'),
			'isEdit' => false,
			'buttonText' => 'Criar tarefa'
		])
	</section>
@endsection