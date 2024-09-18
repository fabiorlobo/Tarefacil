@extends('layouts.dashboard')

@section('title', 'Criar projeto')

@section('content')
	<header class="heading">
		<h1 class="title title--section title--small">Criar projeto</h1>

		<div class="heading__text">
			<p>Preencha os dados abaixo para criar seu projeto:</p>
		</div>
	</header>

	@if (session('status'))
		<div class="alert alert--success">
			<?php \App\Helpers\SvgHelper::render(['name' => 'tasks', 'class' => 'center']); ?>
			<span class="alert__text">{{ session('status') }}</span>
		</div>
	@endif

	<section class="main__section">
		@include('includes.form-projetos', [
			'action' => route('projetos.store'),
			'isEdit' => false,
			'buttonText' => 'Criar projeto',
		])
	</section>
@endsection