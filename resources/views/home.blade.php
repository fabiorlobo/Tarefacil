@extends('layouts.website')

@section('title', 'Home')

@section('content')
	<h2>Tarefácil</h2>
	@if (session('status'))
		<div>{{ session('status') }}</div>
	@endif
	<p>Esta é a página inicial.</p>
@endsection