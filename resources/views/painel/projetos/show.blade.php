@extends('layouts.dashboard')

@section('title', $projeto->nome)

@section('content')
	<h2>{{ $projeto->nome }}</h2>
	<p>{{ $projeto->descricao }}</p>

	@if (session('status'))
		<div class="alert alert-success">{{ session('status') }}</div>
	@endif

	<a href="{{ route('projetos.edit', $projeto->id) }}">Editar Projeto</a>
	<a href="{{ route('listas.create', ['projeto_id' => $projeto->id]) }}">Nova Lista</a>

	<h3>Listas</h3>
	<ul>
		@foreach ($projeto->listas as $lista)
			<li>
				<a href="{{ route('listas.show', $lista->id) }}">{{ $lista->nome }}</a>
				<p>{{ $lista->descricao }}</p>
			</li>
		@endforeach
	</ul>
@endsection