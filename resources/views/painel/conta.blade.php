@extends('layouts.dashboard')

@section('title', 'Minha conta')

@section('content')
	<header class="heading">
		<h1 class="title title--section title--small">Minha conta</h1>

		<div class="heading__text">
			<p>Aqui estão seus dados de cadastro:</p>
		</div>
	</header>

	@if (session('status'))
		<div class="alert alert--success">
			<?php \App\Helpers\SvgHelper::render(['name' => 'tasks', 'class' => 'center']); ?>
			<span class="alert__text">{{ session('status') }}</span>
		</div>
	@endif
	
	@if ($errors->any())
		<div class="alert alert--warning">
			<?php \App\Helpers\SvgHelper::render(['name' => 'warning', 'class' => 'center']); ?>
			<ul class="alert__text alert__text--list">
				@foreach ($errors->all() as $error)
					<li class="alert__text__item">{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif

	<section class="main__section">
		@include('includes.form-cadastro', [
			'action' => route('account.update'),
			'isEdit' => true,
			'isCreate' => false,
			'isSuperAdmin' => false,
			'buttonText' => 'Atualizar conta'
		])
	</section>
	
@endsection