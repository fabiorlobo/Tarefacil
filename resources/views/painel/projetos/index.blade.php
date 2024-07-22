@extends('layouts.dashboard')

@section('title', 'Projetos')

@section('content')
	<h2>Projetos</h2>

	@if (session('status'))
		<div class="alert alert-success">{{ session('status') }}</div>
	@endif

	<a href="{{ route('projetos.create') }}">Criar Novo Projeto</a>

	<ul>
		@foreach ($projetos as $projeto)
			<li>
				<a href="{{ route('projetos.show', $projeto->id) }}">{{ $projeto->nome }}</a>
				<form method="POST" action="{{ route('projetos.destroy', $projeto->id) }}" style="display:inline;">
					@csrf
					@method('DELETE')
					<button type="submit" onclick="return confirm('Tem certeza que deseja excluir este projeto?')">Excluir</button>
				</form>
			</li>
		@endforeach
	</ul>
@endsection