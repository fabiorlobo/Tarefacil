<form class="form" method="POST" action="{{ $action }}">
	@csrf
	@if ($isEdit)
		@method('PUT')
	@endif

	<fieldset class="form__fields box">
		<div class="form__field form__field--1-2">
			<label for="name">Nome completo:</label>
			<input type="text" id="name" name="name" value="{{ old('name', $user->name ?? '') }}" required>
			@error('name')
				<span class="alert alert--form">{{ $message }}</span>
			@enderror
		</div>

		<div class="form__field form__field--1-2">
			<label for="email">E-mail:</label>
			<input type="email" id="email" name="email" value="{{ old('email', $user->email ?? '') }}" required>
			@error('email')
				<span class="alert alert--form">{{ $message }}</span>
			@enderror
		</div>

		<div class="form__field form__field--1-2">
			<label for="password">Nova senha*:</label>
			<input type="password" id="password" name="password">
			@error('password')
				<span class="alert alert--form">{{ $message }}</span>
			@enderror
		</div>

		<div class="form__field form__field--1-2">
			<label for="password_confirmation">Confirmar nova senha*:</label>
			<input type="password" id="password_confirmation" name="password_confirmation">
			@error('password_confirmation')
				<span class="alert alert--form">{{ $message }}</span>
			@enderror
		</div>

		<span class="form__disclaimer">*Deixe em branco para manter a senha atual.</span>

		<button class="form__button button button--max" type="submit">{{ $buttonText }}</button>
	</fieldset>
</form>

@if ($isEdit && !$isSuperAdmin)
	<form class="actions" method="POST" action="{{ route('account.destroy') }}"
		onsubmit="return confirm('Tem certeza que deseja excluir sua conta? Esta ação não pode ser desfeita.');">
		@csrf
		<button class="actions__button actions__button--delete" type="submit">
			<?php \App\Helpers\SvgHelper::render(['name' => 'close', 'class' => 'center']); ?>
			<span class="actions__button__text">Excluir conta</span>
		</button>
	</form>
@endif

@if ($isSuperAdmin)
	<form class="actions" method="POST" action="{{ route('usuarios.destroy', $user->id) }}"
		onsubmit="return confirm('Tem certeza que deseja excluir este usuário? Esta ação não pode ser desfeita.');">
		@csrf
		<button class="actions__button actions__button--delete" type="submit">
			<?php \App\Helpers\SvgHelper::render(['name' => 'close', 'class' => 'center']); ?>
			<span class="actions__button__text">Excluir usuário</span>
		</button>
	</form>
@endif