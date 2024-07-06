<!DOCTYPE html>
<html>

<head>
	<title>@yield('title', 'Tarefácil')</title>
	<!-- Inclua seus estilos e scripts aqui -->
</head>

<body>
	<header>
		<h1>Painel</h1>
		<nav>
			<ul>
				<li><a href="/painel">Projetos</a></li>
				<li><a href="/conta">Minha conta</a></li>
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