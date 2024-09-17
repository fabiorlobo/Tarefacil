<!DOCTYPE html>
<html>

<head>
	<title>@yield('title', 'Tarefácil') | Tarefácil</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
</head>

<body class="template-dashboard">

	<div class="structure wrapper">

		<div class="options">

			<header class="header" role="banner">
				<a
					href="/painel"><?php \App\Helpers\SvgHelper::render(['name' => 'logo', 'type' => 'logo', 'class' => 'center']); ?></a>

				<div class="header__user">
					<img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}">
					<a href="/painel/conta">{{ Auth::user()->name }}</a>
					<form method="POST" action="{{ route('logout') }}">
						@csrf
						<button type="submit">Sair</button>
					</form>
				</div>
			</header>

			<nav class="main-menu">
				<ul class="main-menu__list">
					@if (auth()->user()->is_super_admin)
						<li class="main-menu__item"><a href="{{ route('usuarios.index') }}">Usuários</a></li>
					@endif

					<li class="main-menu__item">
						<a href="/painel/projetos">Projetos</a>
						<ul class="main-menu__submenu">
							<li class="main-menu__item"><a href="{{ route('projetos.create') }}">Novo projeto</a></li>
						</ul>
					</li>

					<li class="main-menu__item">
						<a href="/painel/listas">Listas de tarefas</a>
						<ul class="main-menu__submenu">
							<li class="main-menu__item"><a href="{{ route('listas.create') }}">Nova lista</a></li>
							<li class="main-menu__item"><a href="{{ route('tarefas.create') }}">Nova tarefa</a></li>
						</ul>
					</li>
				</ul>
			</nav>

			<footer role="contentinfo" class="footer">

				<ul class="footer__links">
					<li><a href="/sobre" target="_blank" rel="noopener noreferrer">Sobre</a></li>
					<li><a href="/privacidade" target="_blank" rel="noopener noreferrer">Privacidade</a></li>
				</ul>

				<span class="footer__copyright">&copy; 2024 Tarefácil. Todos os direitos reservados.</span>

			</footer>

		</div>

		<main class="main max" id="main" role="main">
			@yield('content')
		</main>

	</div>

	<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<script src="{{ asset('assets/scripts/app.js') }}"></script>
	@stack('scripts')

</body>

</html>