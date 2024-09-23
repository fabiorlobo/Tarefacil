@extends('layouts.dashboard')

@section('title', 'Criar Anotação')

@section('content')
	<header class="heading">
		@php
			$projetoSelecionado = $projetos->where('id', $projetoIdSelecionado)->first();
		@endphp

		<h1 class="title title--section title--small">
			@if ($projetoSelecionado)
				<a href="{{ route('projetos.show', $projetoSelecionado->id) }}">{{ $projetoSelecionado->nome }}</a> › 
			@endif
			Criar Anotação
		</h1>

		<div class="heading__text">
			<p>Preencha os dados abaixo para criar sua anotação:</p>
		</div>
	</header>

	@if (session('status'))
		<div class="alert alert--success">
			<?php \App\Helpers\SvgHelper::render(['name' => 'tasks', 'class' => 'center']); ?>
			<span class="alert__text">{{ session('status') }}</span>
		</div>
	@endif

	<section class="main__section">
		@include('includes.form-notas', [
			'action' => route('notas.store'),
			'isEdit' => false,
			'buttonText' => 'Criar anotação'
		])
	</section>

	<script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			const quill = new Quill('#editor', {
				theme: 'snow'
			});

			const form = document.getElementById('notaForm');
			form.addEventListener('submit', function() {
				const nota = document.querySelector('textarea[name="nota"]');
				nota.value = quill.root.innerHTML;
			});
		});
	</script>
@endsection