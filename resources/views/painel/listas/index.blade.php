@extends('layouts.dashboard')

@section('title', 'Listas')

@section('content')
	<h2>Listas</h2>
	@if (session('status'))
		<div>{{ session('status') }}</div>
	@endif
	<a href="{{ route('listas.create') }}">Criar Nova Lista</a>
	<ul>
		@foreach ($listas as $lista)
			<li>
				<a href="{{ route('listas.show', $lista->id) }}">{{ $lista->nome }}</a>
				<form method="POST" action="{{ route('listas.destroy', $lista->id) }}" style="display:inline;">
					@csrf
					@method('DELETE')
					<button type="submit" onclick="return confirm('Tem certeza que deseja excluir esta lista?')">Excluir</button>
				</form>
			</li>
		@endforeach
	</ul>
@endsection