@extends('layouts.website')

@section('title', 'Crie sua conta')

@section('content')
	<section class="main__section main__section--content">
		<div class="singular singular--form">
			<h1 class="title title--medium">Crie sua conta</h1>

			@if ($errors->any())
				<div class="alert alert--warning">
					<?php \App\Helpers\SvgHelper::render(['name' => 'warning', 'class' => 'center']); ?>
					<ul class="alert__text alert__text--list">
						@foreach ($errors->all() as $error)
							<li class="alert__text__item">{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif

			@include('includes.form-cadastro', [
				'action' => route('register'),
				'isEdit' => false,
				'isCreate' => true,
				'isSuperAdmin' => false,
				'buttonText' => 'Cadastrar'
			])
		</div>
	</section>
@endsection