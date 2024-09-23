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

	@if($users->count() > 0)
		<section class="main__section main__section--separator">
			<div class="loop">
				@foreach ($users as $user)
					@php
						$projetosCount = $user->projetos->count();
						$listasCount = $user->listas->count();
						$notasCount = $user->notas->count();
					@endphp
					<div class="loop__item box">
						<h3 class="title title--smaller">
							<a href="{{ route('usuarios.edit', $user->id) }}">{{ $user->name }}</a>
						</h3>

						<div class="loop__item__description">
							<p>{{ $user->email }}</p>
						</div>

						@if($projetosCount > 0 || $listasCount > 0 || $notasCount > 0)
							<div class="loop__item__info">
								@if($projetosCount > 0)
									<span class="loop__item__info__data">{{ $projetosCount }} projeto{{ $projetosCount > 1 ? 's' : '' }}</span>
								@endif
								@if($listasCount > 0)
									<span class="loop__item__info__data">{{ $listasCount }} lista{{ $listasCount > 1 ? 's' : '' }}</span>
								@endif
								@if($notasCount > 0)
									<span class="loop__item__info__data">{{ $notasCount }} nota{{ $notasCount > 1 ? 's' : '' }}</span>
								@endif
							</div>
						@endif
					</div>
				@endforeach
			</div>
		</section>
	@endif
@endsection