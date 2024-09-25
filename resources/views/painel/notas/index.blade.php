@extends('layouts.dashboard')

@section('title', 'Anotações')

@section('content')
	<header class="heading">
		<h1 class="title title--section title--small">Minhas anotações</h1>

		<div class="actions">
			<a class="actions__button" href="{{ route('notas.create') }}">
				<?php \App\Helpers\SvgHelper::render(['name' => 'more', 'class' => 'center']); ?>
				<span class="actions__button__text">Nova anotação</span>
			</a>
		</div>
	</header>

	@if (session('status'))
		<div class="alert alert--success">
			<?php \App\Helpers\SvgHelper::render(['name' => 'tasks', 'class' => 'center']); ?>
			<span class="alert__text">{{ session('status') }}</span>
		</div>
	@endif

	@include('includes.notas')
@endsection