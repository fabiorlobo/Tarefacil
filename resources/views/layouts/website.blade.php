<!DOCTYPE html>
<html>

<head>
	<title>@yield('title', 'Tarefácil') | Tarefácil</title>
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
	<link rel="stylesheet" href="{{ asset('assets/styles/global.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/styles/website.css') }}">
</head>

<body class="template-website">

	<header class="header wrapper" role="banner">
		<div class="header__bar max">
			@if(Route::is('home'))
				<h1>
			@endif
				<a class="header__logo"
					href="/"><?php \App\Helpers\SvgHelper::render(['name' => 'logo', 'type' => 'logo', 'class' => 'center']); ?></a>
				@if(Route::is('home'))
					</h1>
				@endif

			<nav class="main-menu">
				<ul class="main-menu__list">
					@guest
						<li class="main-menu__item"><a href="/entrar">Login</a></li>
						<li class="main-menu__item"><a class="button button--small" href="/cadastro">Criar conta</a></li>
					@endguest
					@auth
						<li class="main-menu__item"><a href="/painel">Painel</a></li>
						<li class="main-menu__item"><a class="button button--small" href="/painel/conta">Minha conta</a></li>
					@endauth
				</ul>
			</nav>

		</div>
	</header>

	<main class="main wrapper" id="main" role="main">
		@yield('content')
	</main>

	<footer role="contentinfo" class="footer footer--end wrapper">
		<div class="footer__bar">
			@include('includes.footer')
		</div>
	</footer>

	@stack('scripts')

</body>

</html>