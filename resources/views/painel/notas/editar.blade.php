@extends('layouts.dashboard')

@section('title', 'Editar anotação')

@section('content')
	<header class="heading">
		<h1 class="title title--section title--small">
			@if (isset($nota->projeto) && $nota->projeto)
				<a href="{{ route('projetos.show', $nota->projeto->id) }}">{{ $nota->projeto->nome }}</a> › 
			@endif
			Editar anotação
		</h1>

		<div class="heading__text">
			<p>Preencha os dados abaixo para editar sua anotação:</p>
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
			'action' => route('notas.update', $nota->id),
			'isEdit' => true,
			'buttonText' => 'Atualizar anotação',
			'projetoIdSelecionado' => old('projeto_id', $nota->projeto_id ?? '')
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