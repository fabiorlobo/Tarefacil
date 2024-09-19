<form class="form" method="POST" action="{{ $action }}">
	@csrf
	@if ($isEdit)
		@method('PUT')
	@endif

	<fieldset class="form__fields box">
		<div class="form__field form__field--1-1">
			<label for="descricao">Descrição:</label>
			<textarea id="descricao" name="descricao">{{ old('descricao', $tarefa->descricao ?? '') }}</textarea>
			@error('descricao')
				<span class="alert alert--form">{{ $message }}</span>
			@enderror
		</div>

		<div class="form__field form__field--1-1">
			<label for="lista_id">Lista:</label>
			<select class="select2" id="lista_id" name="lista_id">
				<option value="">Selecione ou crie uma lista</option>
				@foreach ($listas as $lista)
					<option value="{{ $lista->id }}" {{ isset($listaId) && $listaId == $lista->id ? 'selected' : '' }}>
						{{ $lista->nome }}
					</option>
				@endforeach
			</select>
			@error('lista_id')
				<span class="alert alert--form">{{ $message }}</span>
			@enderror
		</div>

		<div class="form__field form__field--1-2">
			<label>Tempo previsto:</label>

			<div class="form__fields">
				<div class="form__field form__field--1-2 form__field--time">
					<input type="number" id="tempo_previsto_horas" name="tempo_previsto_horas" value="{{ old('tempo_previsto_horas', $tarefa->tempo_previsto_horas ?? '') }}">
					<label for="tempo_previsto_horas">Horas</label>
					@error('tempo_previsto_horas')
						<span class="alert alert--form">{{ $message }}</span>
					@enderror
				</div>

				<div class="form__field form__field--1-2 form__field--time">
					<input type="number" id="tempo_previsto_minutos" name="tempo_previsto_minutos" value="{{ old('tempo_previsto_minutos', $tarefa->tempo_previsto_minutos ?? '') }}" max="59">
					<label for="tempo_previsto_minutos">Minutos</label>
					@error('tempo_previsto_minutos')
						<span class="alert alert--form">{{ $message }}</span>
					@enderror
				</div>
			</div>
		</div>

		<div class="form__field form__field--1-2">
			<label>Tempo utilizado:</label>

			<div class="form__fields">
				<div class="form__field form__field--1-2 form__field--time">
					<input type="number" id="tempo_utilizado_horas" name="tempo_utilizado_horas" value="{{ old('tempo_utilizado_horas', $tarefa->tempo_utilizado_horas ?? '') }}">
					<label for="tempo_utilizado_horas">Horas</label>
					@error('tempo_utilizado_horas')
						<span class="alert alert--form">{{ $message }}</span>
					@enderror
				</div>

				<div class="form__field form__field--1-2 form__field--time">
					<input type="number" id="tempo_utilizado_minutos" name="tempo_utilizado_minutos" value="{{ old('tempo_utilizado_minutos', $tarefa->tempo_utilizado_minutos ?? '') }}" max="59">
					<label for="tempo_utilizado_minutos">Minutos</label>
					@error('tempo_utilizado_minutos')
						<span class="alert alert--form">{{ $message }}</span>
					@enderror
				</div>
			</div>
		</div>

		<button class="form__button button button--max" type="submit">{{ $buttonText }}</button>
	</fieldset>
	
</form>

@if ($isEdit)
	<form class="actions" method="POST" action="{{ route('tarefas.destroy', $tarefa->id) }}">
		@csrf
		@method('DELETE')
		<button class="actions__button actions__button--delete" type="submit"
			onclick="return confirm('Tem certeza que deseja excluir esta tarefa?')">
			<?php \App\Helpers\SvgHelper::render(['name' => 'close', 'class' => 'center']); ?>
			<span class="actions__button__text">Excluir</span>
		</button>
	</form>
@endif