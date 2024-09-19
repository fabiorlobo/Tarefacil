@extends('layouts.dashboard')

@section('title', 'Gerenciar Usuários')

@section('content')
	<header class="heading">
		<h1 class="title title--section title--small">Gerenciar usuários</h1>
	</header>

	@if (session('status'))
		<div class="alert alert--success">
			<?php \App\Helpers\SvgHelper::render(['name' => 'tasks', 'class' => 'center']); ?>
			<span class="alert__text">{{ session('status') }}</span>
		</div>
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