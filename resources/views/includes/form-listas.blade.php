<form class="form" method="POST" action="{{ $action }}">
	@csrf
	@if ($isEdit)
		@method('PUT')
	@endif

	<fieldset class="form__fields box">
		<div class="form__field form__field--1-1">
			<label for="nome">Nome:</label>
			<input type="text" id="nome" name="nome" value="{{ old('nome', $lista->nome ?? '') }}" required>
			@error('nome')
				<span class="alert alert--form">{{ $message }}</span>
			@enderror
		</div>

		<div class="form__field form__field--1-1">
			<label for="descricao">Descrição:</label>
			<textarea id="descricao" name="descricao">{{ old('descricao', $lista->descricao ?? '') }}</textarea>
			@error('descricao')
				<span class="alert alert--form">{{ $message }}</span>
			@enderror
		</div>

		<div class="form__field form__field--1-2">
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

		<div class="form__field form__field--1-2">
			<label>Tempo reservado:</label>

			<div class="form__fields">
				<div class="form__field form__field--1-2 form__field--time">
					<input type="number" id="tempo_previsto_horas" name="tempo_previsto_horas" value="{{ old('tempo_previsto_horas', $lista->tempo_previsto_horas ?? '') }}">
					<label for="tempo_previsto_horas">Horas</label>
					@error('tempo_previsto_horas')
						<span class="alert alert--form">{{ $message }}</span>
					@enderror
				</div>

				<div class="form__field form__field--1-2 form__field--time">
					<input type="number" id="tempo_previsto_minutos" name="tempo_previsto_minutos" value="{{ old('tempo_previsto_minutos', $lista->tempo_previsto_minutos ?? '') }}" max="59">
					<label for="tempo_previsto_minutos">Minutos</label>
					@error('tempo_previsto_minutos')
						<span class="alert alert--form">{{ $message }}</span>
					@enderror
				</div>
			</div>
		</div>

		<button class="form__button button button--max" type="submit">{{ $buttonText }}</button>
	</fieldset>
	
</form>

@if ($isEdit)
	<form class="actions" method="POST" action="{{ route('listas.destroy', $lista->id) }}">
		@csrf
		@method('DELETE')
		<button class="actions__button actions__button--delete" type="submit"
			onclick="return confirm('Tem certeza que deseja excluir esta lista?')">
			<?php \App\Helpers\SvgHelper::render(['name' => 'close', 'class' => 'center']); ?>
			<span class="actions__button__text">Excluir</span>
		</button>
	</form>
@endif