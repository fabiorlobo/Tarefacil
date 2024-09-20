@extends('layouts.website')

@section('title', 'Política de privacidade')

@section('content')
	<section class="main__section main__section--content">
		<article class="singular">
			<h1 class="title title--medium">Política de privacidade</h1>

			<div class="singular__content">
				<p>A privacidade dos nossos usuários é uma prioridade no Tarefácil. Esta Política de Privacidade descreve como coletamos, usamos e protegemos seus dados pessoais. Ao utilizar o Tarefácil, você concorda com a coleta e o uso de informações conforme descrito nesta política.</p>

				<h2>Dados coletados</h2>
				<p>O Tarefácil coleta apenas os seguintes dados pessoais: nome e e-mail. Esses dados são necessários para identificar você na plataforma e proporcionar uma experiência personalizada no gerenciamento de suas tarefas.</p>

				<h2>Finalidade da coleta de dados</h2>
				<p>Os dados coletados têm a única finalidade de identificar e autenticar o usuário na plataforma. Nós não compartilhamos esses dados com terceiros, e eles não serão usados para fins comerciais ou publicitários.</p>

				<h2>Direitos do usuário</h2>
				<p>Você tem o direito de excluir sua conta a qualquer momento. Quando a conta é excluída, todos os seus dados, incluindo nome e e-mail, são permanentemente removidos da plataforma.</p>

				<h2>Segurança dos dados</h2>
				<p>O Tarefácil utiliza medidas de segurança adequadas para proteger seus dados contra acesso não autorizado, perda ou alteração. No entanto, nenhuma transmissão de dados pela internet é totalmente segura, e não podemos garantir a segurança absoluta das informações transmitidas.</p>

				<h2>Contato</h2>
				<p>Em caso de dúvidas ou solicitações relacionadas à privacidade, você pode entrar em contato conosco pelo e-mail suporte@wowf.com.br.</p>
			</div>
		</article>
	</section>

	@include('includes.cta-home')
@endsection