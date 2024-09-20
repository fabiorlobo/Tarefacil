@extends('layouts.dashboard')

@section('title', 'Editar Usuário')

@section('content')
	<header class="heading">
		<h1 class="title title--section title--small">Editar usuário</h1>

		<div class="heading__text">
			<p>Aqui estão os dados do usuário selecionado:</p>
		</div>
	</header>

	@if (session('status'))
		<div class="alert alert--success">
			<?php \App\Helpers\SvgHelper::render(['name' => 'tasks', 'class' => 'center']); ?>
			<span class="alert__text">{{ session('status') }}</span>
		</div>
	@endif

	<section class="main__section">
		@include('includes.form-cadastro', [
			'action' => route('usuarios.update', $user->id),
			'isEdit' => true,
			'isSuperAdmin' => true,
			'buttonText' => 'Atualizar cadastro'
		])
	</section>
@endsection