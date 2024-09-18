@extends('layouts.dashboard')

@section('title', 'Editar projeto')

@section('content')
	<header class="heading">
		<h1 class="title title--section title--small">Editar projeto</h1>

		<div class="heading__text">
			<p>Preencha os dados abaixo para editar seu projeto:</p>
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
			'action' => route('projetos.update', $projeto->id),
			'isEdit' => true,
			'buttonText' => 'Atualizar projeto',
			'projeto' => $projeto
		])
	</section>
@endsection