@extends('layouts.dashboard')

@section('title', 'Painel')

@section('content')
	<h2>Painel de tarefas</h2>
	<div>
		<img src="{{ Auth::user()->avatar }}" alt="Avatar do usuário">
		<p>Bem-vindo, {{ Auth::user()->name }}</p>
	</div>
@endsection