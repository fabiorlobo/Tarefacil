@extends('layouts.dashboard')

@section('title', $nota->nome)

@section('content')
	<header class="heading">
		<h1 class="title title--section title--small">
			@if (isset($nota->projeto) && $nota->projeto)
				<a href="{{ route('projetos.show', $nota->projeto->id) }}">{{ $nota->projeto->nome }}</a> ›
			@endif
			Editar anotação
		</h1>

		@if ($nota->descricao)
			<div class="heading__text">
				<p>{{ $nota->descricao }}</p>
			</div>
		@endif

		<div class="actions">
			<a class="actions__button" href="{{ route('notas.edit', $nota->id) }}">
				<?php \App\Helpers\SvgHelper::render(['name' => 'edit', 'class' => 'center']); ?>
				<span class="actions__button__text">Editar</span>
			</a>
		</div>
	</header>

	<section class="main__section">
		<div class="quill-result box" id="quillContent">
			{!! $nota->nota !!}
		</div>

		<div class="actions">
			<button class="actions__button" id="downloadPdfButton">
				<?php \App\Helpers\SvgHelper::render(['name' => 'download', 'class' => 'center']); ?>
				<span class="actions__button__text">Baixar PDF</span>
			</button>
		</div>
	</section>
@endsection

@push('scripts')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/dompurify/2.3.8/purify.min.js"></script>

	<script>
		document.getElementById('downloadPdfButton').addEventListener('click', function () {
			const { jsPDF } = window.jspdf;
			const doc = new jsPDF({
				unit: 'pt',
				format: 'a4'
			});

			let notaNome = "{{ $nota->nome }}".replace(/\s+/g, '_').toLowerCase();
			let content = document.getElementById('quillContent').innerHTML;

			doc.html(content, {
				callback: function (doc) {
					doc.save(`${notaNome}.pdf`);
				},
				x: 20,
				y: 20,
				width: 555,
				windowWidth: 800,
				autoPaging: true
			});
		});
	</script>
@endpush