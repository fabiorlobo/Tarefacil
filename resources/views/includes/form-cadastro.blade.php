<form class="form @if($isCreate) singular__content @endif" method="POST" action="{{ $action }}">
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
			<label for="password">
				@if ($isCreate)
					Senha:
				@else
					Nova senha*:
				@endif
			</label>
			<input type="password" id="password" name="password" @if($isCreate) required @endif>
			@error('password')
				<span class="alert alert--form">{{ $message }}</span>
			@enderror
		</div>

		<div class="form__field form__field--1-2">
			<label for="password_confirmation">
				@if ($isCreate)
					Confirmar senha:
				@else
					Confirmar nova senha*:
				@endif
			</label>
			<input type="password" id="password_confirmation" name="password_confirmation" @if($isCreate) required @endif>
			@error('password_confirmation')
				<span class="alert alert--form">{{ $message }}</span>
			@enderror
		</div>

		@if ($isCreate)
			<div class="form__field form__field--1-1 form__field--checkbox">
				<input type="checkbox" id="terms" name="terms" required>
				<label for="terms">Concordo com a <a href="/privacidade" target="_blank" rel="noopener noreferrer">política de privacidade</a></label>
				@error('terms')
					<span class="alert alert--form">{{ $message }}</span>
				@enderror
			</div>
		@endif

		@if($isCreate)
			<div class="form__field form__field--1-1">
				<div class="cf-turnstile" data-sitekey="0x4AAAAAAAkviOdRtk7oKbKv"></div>
				@error('cf-turnstile-response')
					<span class="alert alert--form">{{ $message }}</span>
				@enderror
			</div>
		@endif

		@if ($isEdit || $isSuperAdmin)
			<span class="form__disclaimer">*Deixe em branco para manter a senha atual.</span>
		@endif

		<button class="form__button button button--max" type="submit">{{ $buttonText }}</button>

		@if ($isCreate)
			<a class="form__button button button--max button--google" href="{{ url('auth/google') }}">Cadastrar com Google</a>
		@endif
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
		@method('DELETE')
		<button class="actions__button actions__button--delete" type="submit">
			<?php \App\Helpers\SvgHelper::render(['name' => 'close', 'class' => 'center']); ?>
			<span class="actions__button__text">Excluir usuário</span>
		</button>
	</form>
@endif