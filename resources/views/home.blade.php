@extends('layouts.website')

@section('title', 'Home')

@section('content')
	<section class="main__section featured">
		<h2 class="title title--big">Nunca foi tão fácil gerenciar tarefas</h2>
		<p>Controle cada minuto de suas tarefas e projetos com o <strong>Tarefácil</strong>!</p>
		<a class="button" href="/painel/cadastro">Comece agora!</a>
	</section>

	<div class="max max--total">
		<div class="wrapper">
			<section class="main__section screen">
				<div class="screen__col screen__col--text">
					<h3 class="title title--medium">Crie e gerencie projetos</h3>
					<p>Organize seu trabalho com facilidade criando projetos personalizados.</p>
					<p>Use-os para acompanhar mensalmente seus clientes, gerenciar projetos com início, meio e fim, ou até mesmo para organizar tarefas domésticas.</p>
				</div>

				<div class="screen__col screen__col--img">
					<div class="screen__img box">
						<img src="{{ asset('assets/images/screens/crie-gerencie-projetos.png') }}" alt="Crie e gerencie projetos">
					</div>
				</div>
			</section>
		</div>
	</div>

	<div class="max max--total">
		<div class="wrapper">
			<section class="main__section screen">
				<div class="screen__col screen__col--img">
					<div class="screen__img box">
						<img src="{{ asset('assets/images/screens/crie-gerencie-projetos.png') }}" alt="Organize suas tarefas">
					</div>
				</div>

				<div class="screen__col screen__col--text">
					<h3 class="title title--medium">Organize suas tarefas</h3>
					<p>Crie listas de tarefas detalhadas, com estimativa de tempo e cronômetro integrado.</p>
					<p>Mantenha todas as suas atividades em ordem e maximize sua produtividade.</p>
				</div>
			</section>
		</div>
	</div>

	<div class="max max--total">
		<div class="wrapper">
			<section class="main__section screen">
				<div class="screen__col screen__col--text">
					<h3 class="title title--medium">Controle seu tempo</h3>
					<p>Monitore cada minuto de trabalho com o cronômetro embutido e tenha controle total sobre o tempo gasto em cada tarefa.</p>
					<p>Melhore sua eficiência ao acompanhar o tempo previsto e utilizado e ajuste suas atividades de acordo com suas necessidades.</p>
					<p>Além disso, gere relatórios completos com o tempo utilizado, facilitando a gestão e a análise de sua produtividade.</p>
				</div>

				<div class="screen__col screen__col--img">
					<div class="screen__img box">
						<img src="{{ asset('assets/images/screens/controle-tempo.png') }}" alt="Controle seu tempo">
					</div>
				</div>
			</section>
		</div>
	</div>

	@include('includes.cta-home')
@endsection