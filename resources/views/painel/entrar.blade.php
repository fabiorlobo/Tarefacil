@extends('layouts.website')

@section('title', 'Entrar')

@section('content')
	<section class="main__section main__section--content">
		<div class="singular singular--form singular--mini">
			<h1 class="title title--medium">Entrar</h1>

			@if ($errors->any())
				<div class="alert alert--warning">
					<?php \App\Helpers\SvgHelper::render(['name' => 'warning', 'class' => 'center']); ?>
					<ul class="alert__text alert__text--list">
						@foreach ($errors->all() as $error)
							<li class="alert__text__item">{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif

			<form class="singular__content" class="form" method="POST" action="{{ route('login') }}">
				<fieldset class="form__fields box">
					@csrf
					<div class="form__field form__field--1-1">
						<label for="email">Email:</label>
						<input type="email" id="email" name="email" required value="{{ old('email') }}">
						@error('email')
						<span class="alert alert--form">{{ $message }}</span>
						@enderror
					</div>

					<div class="form__field form__field--1-1">
						<label for="password">Senha:</label>
						<input type="password" id="password" name="password" required>
						@error('password')
						<span class="alert alert--form">{{ $message }}</span>
						@enderror
					</div>

					<div class="form__field form__field--1-1 form__field--checkbox">
						<input type="checkbox" id="remember" name="remember">
						<label for="remember">Lembrar-me</label>
					</div>

					<button class="form__button button button--max" type="submit">Entrar</button>

					<a class="form__button button button--max button--google" href="{{ url('auth/google') }}">Entrar com Google</a>
				</fieldset>
			</form>
		</div>
	</section>
@endsection