@extends('layouts.dashboard')

@section('title', 'Gerenciar Usuários')

@section('content')
	<h1>Gerenciar Usuários</h1>

	@if (session('status'))
		<div class="alert alert-success">{{ session('status') }}</div>
	@endif

	<table>
		<thead>
			<tr>
				<th>Nome</th>
				<th>Email</th>
				<th>Ações</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($users as $user)
				<tr>
					<td>{{ $user->name }}</td>
					<td>{{ $user->email }}</td>
					<td>
						<form action="{{ route('usuarios.destroy', $user->id) }}" method="POST"
							onsubmit="return confirm('Tem certeza que deseja excluir este usuário?');">
							@csrf
							@method('DELETE')
							<button type="submit">Excluir</button>
						</form>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection