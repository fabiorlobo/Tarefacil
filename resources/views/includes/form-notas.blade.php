<form class="form" method="POST" action="{{ $action }}" id="notaForm">
	@csrf
	@if ($isEdit)
		@method('PUT')
	@endif

	<fieldset class="form__fields box">
		<div class="form__field form__field--1-1">
			<label for="nome">Nome:</label>
			<input type="text" id="nome" name="nome" value="{{ old('nome', $nota->nome ?? '') }}" required>
			@error('nome')
				<span class="alert alert--form">{{ $message }}</span>
			@enderror
		</div>

		<div class="form__field form__field--1-1">
			<label for="descricao">Descrição:</label>
			<textarea id="descricao" name="descricao">{{ old('descricao', $nota->descricao ?? '') }}</textarea>
			@error('descricao')
				<span class="alert alert--form">{{ $message }}</span>
			@enderror
		</div>

		<div class="form__field form__field--1-1">
			<label for="nota">Nota:</label>
			<div class="quill max">
				<div id="editor">{!! old('nota', $nota->nota ?? '') !!}</div> 
			</div>
			<textarea id="nota" name="nota" style="display:none">{{ old('nota', $nota->nota ?? '') }}</textarea>
			@error('nota')
				<span class="alert alert--form">{{ $message }}</span>
			@enderror
		</div>

		<div class="form__field form__field--1-1">
			<label for="projeto_id">Projeto:</label>
			<select class="select2" id="projeto_id" name="projeto_id">
				<option value="">Selecione ou crie um projeto</option>
				@foreach ($projetos as $projeto)
					<option value="{{ $projeto->id }}" {{ old('projeto_id', $projetoIdSelecionado) == $projeto->id ? 'selected' : '' }}>
						{{ $projeto->nome }}
					</option>
				@endforeach
			</select>
			@error('projeto_id')
				<span class="alert alert--form">{{ $message }}</span>
			@enderror
		</div>

		<button class="form__button button button--max" type="submit">{{ $buttonText }}</button>
	</fieldset>
</form>

@if ($isEdit)
	<form class="actions" method="POST" action="{{ route('notas.destroy', $nota->id) }}">
		@csrf
		@method('DELETE')
		<button class="actions__button actions__button--delete" type="submit"
			onclick="return confirm('Tem certeza que deseja excluir esta anotação?')">
			<?php \App\Helpers\SvgHelper::render(['name' => 'close', 'class' => 'center']); ?>
			<span class="actions__button__text">Excluir</span>
		</button>
	</form>
@endif