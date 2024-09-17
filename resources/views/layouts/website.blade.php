<!DOCTYPE html>
<html>

<head>
	<title>@yield('title', 'Tarefácil') | Tarefácil</title>
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
</head>

<body class="template-website">
	<header>
		<h1>Tarefácil</h1>
		<nav>
			<ul>
				<li><a href="/">Home</a></li>
				<li><a href="/sobre">Sobre</a></li>
				<li><a href="/painel/entrar">Entrar</a></li>
				<li><a href="/painel/cadastro">Cadastre-se</a></li>
			</ul>
		</nav>
	</header>

	<main>
		@yield('content')
	</main>

	<footer>
		<p>&copy; 2024 Tarefácil. Todos os direitos reservados.</p>
	</footer>
</body>

</html>