<form class="form" method="POST" action="{{ $action }}">
	@csrf
	@if ($isEdit)
		@method('PUT')
	@endif

	<fieldset class="form__fields box">
		<div class="form__field form__field--1-1">
			<label for="nome">Nome:</label>
			<input type="text" id="nome" name="nome" value="{{ old('nome', $projeto->nome ?? '') }}" required>
			@error('nome')
				<span class="alert alert--form">{{ $message }}</span>
			@enderror
		</div>

		<div class="form__field form__field--1-1">
			<label for="descricao">Descrição:</label>
			<textarea id="descricao" name="descricao">{{ old('descricao', $projeto->descricao ?? '') }}</textarea>
			@error('descricao')
				<span class="alert alert--form">{{ $message }}</span>
			@enderror
		</div>

		<button class="form__button button button--max" type="submit">{{ $buttonText }}</button>
	</fieldset>
	
</form>

@if ($isEdit)
	<form class="actions" method="POST" action="{{ route('projetos.destroy', $projeto->id) }}">
		@csrf
		@method('DELETE')
		<button class="actions__button actions__button--delete" type="submit"
			onclick="return confirm('Tem certeza que deseja excluir este projeto?')">
			<?php \App\Helpers\SvgHelper::render(['name' => 'close', 'class' => 'center']); ?>
			<span class="actions__button__text">Excluir</span>
		</button>
	</form>
@endif