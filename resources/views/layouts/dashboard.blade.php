<!DOCTYPE html>
<html>

<head>
	<title>@yield('title', 'Tarefácil') | Tarefácil</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
	<link rel="stylesheet" href="{{ asset('assets/styles/global.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/styles/dashboard.css') }}">
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
</head>

<body class="template-dashboard">

	<div class="structure wrapper">

		<div class="options">

			<header class="header" role="banner">
				<a class="header__logo" href="/painel"><?php \App\Helpers\SvgHelper::render(['name' => 'logo', 'type' => 'logo', 'class' => 'center']); ?></a>

				<div class="header__user">
					@php
						$avatarUrl = Auth::user()->avatar;
						$separator = strpos($avatarUrl, '?') === false ? '?' : '&';
						$avatarUrl .= $separator . 's=30';
					@endphp
					<a class="header__user__link" href="/painel/conta">
						<img class="header__user__avatar" src="{{ $avatarUrl }}" alt="{{ Auth::user()->name }}" width="30" height="30">
						<b class="header__user__name">{{ Auth::user()->name }}</b>
					</a>
					<form class="header__user__form" method="POST" action="{{ route('logout') }}">
						@csrf
						<button class="header__user__logout" type="submit" aria-label="Sair">
							<?php \App\Helpers\SvgHelper::render(['name' => 'close', 'class' => 'center']); ?>
						</button>
					</form>
				</div>
			</header>

			@include('includes.menu-dashboard')

			<footer role="contentinfo" class="footer footer--sidebar">

				@include('includes.footer')

			</footer>

		</div>

		<main class="main max" id="main" role="main">
			@yield('content')
		</main>

	</div>

	<footer role="contentinfo" class="footer footer--end wrapper">
		<div class="footer__bar">
			@include('includes.footer')
		</div>
	</footer>

	<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<script src="{{ asset('assets/scripts/app.js') }}"></script>
	@stack('scripts')

</body>

</html>