<!DOCTYPE html>
<html>

<head>
	<title>@yield('title', 'Tarefácil')</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
</head>

<body>
	<header>
		<h1>Painel</h1>
		<nav>
			<ul>
				<li><a href="/painel">Projetos</a></li>
				<li><a href="/painel/listas">Listas</a></li>
				<li><a href="/painel/tarefas/criar">Criar tarefa</a></li>
				<li><a href="/painel/conta">Minha conta</a></li>
				<li>
					<form method="POST" action="{{ route('logout') }}">
						@csrf
						<button type="submit">Sair</button>
					</form>
				</li>
			</ul>
		</nav>
	</header>

	<main>
		@yield('content')
	</main>

	<footer>
		<p>&copy; 2024 Tarefácil. Todos os direitos reservados.</p>
	</footer>

	<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<script src="{{ asset('assets/scripts/app.js') }}"></script>
	@stack('scripts')
</body>

</html>