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

			<nav id="primary" class="main-menu">
				<ul class="main-menu__list">
					<li class="main-menu__item">
						<a class="main-menu__item__link" href="/painel">
							<?php \App\Helpers\SvgHelper::render(['name' => 'home', 'class' => 'center']); ?>
							<span class="main-menu__item__text">Home</span>
						</a>
					</li>

					@if (auth()->user()->is_super_admin)
						<li class="main-menu__item">
							<a class="main-menu__item__link" href="{{ route('usuarios.index') }}">
								<?php \App\Helpers\SvgHelper::render(['name' => 'user', 'class' => 'center']); ?>
								<span class="main-menu__item__text">Usuários</span>
							</a>
						</li>
					@endif

					<li class="main-menu__item main-menu__item--submenu">
						<a class="main-menu__item__link" href="/painel/projetos">
							<?php \App\Helpers\SvgHelper::render(['name' => 'projects', 'class' => 'center']); ?>
							<span class="main-menu__item__text">Projetos</span>
						</a>
						<span class="main-menu__item__expand">Expandir</span>
						<ul class="main-menu__submenu">
							<li class="main-menu__submenu__item">
								<a class="main-menu__submenu__item__link" href="{{ route('projetos.create') }}">
									<span class="main-menu__submenu__item__text">Novo projeto</span>
									<?php \App\Helpers\SvgHelper::render(['name' => 'more', 'class' => 'center']); ?>
								</a>
							</li>
						</ul>
					</li>

					<li class="main-menu__item main-menu__item--submenu">
						<a class="main-menu__item__link" href="/painel/listas">
							<?php \App\Helpers\SvgHelper::render(['name' => 'tasks', 'class' => 'center']); ?>
							<span class="main-menu__item__text">Tarefas</span>
						</a>
						<span class="main-menu__item__expand">Expandir</span>
						<ul class="main-menu__submenu">
							<li class="main-menu__submenu__item">
								<a class="main-menu__submenu__item__link" href="{{ route('listas.create') }}">
									<span class="main-menu__submenu__item__text">Nova lista</span>
									<?php \App\Helpers\SvgHelper::render(['name' => 'more', 'class' => 'center']); ?>
								</a>
							</li>
							<li class="main-menu__submenu__item">
								<a class="main-menu__submenu__item__link" href="{{ route('tarefas.create') }}">
									<span class="main-menu__submenu__item__text">Nova tarefa</span>
									<?php \App\Helpers\SvgHelper::render(['name' => 'more', 'class' => 'center']); ?>
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</nav>

			<footer role="contentinfo" class="footer footer--sidebar">

				@include('includes.footer')

			</footer>

		</div>

		<main class="main max" id="main" role="main">
			@yield('content')
		</main>

	</div>

	<div class="wrapper">
		<footer role="contentinfo" class="footer footer--end">

			@include('includes.footer')

		</footer>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<script src="{{ asset('assets/scripts/app.js') }}"></script>
	@stack('scripts')

</body>

</html>