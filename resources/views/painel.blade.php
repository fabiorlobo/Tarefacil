@extends('layouts.dashboard')

@section('title', 'Painel')

@section('content')
	<header class="heading">
		<h1 class="title title--section title--small">Meu painel</h1>
		<div class="heading__text">
			<p>Olá, {{ Auth::user()->name }}!</p>
		</div>
	</header>

	@include('includes.projetos')
	@include('includes.listas', ['listas' => $listas])
@endsection