@extends('adminlte::page')

@section('title', 'Cadastrar Perfil')

@section('content_header')
<h1>Cadatrar Novo perfil <a href="{{route('profiles.store')}}" class="btn btn-dark">Voltar</a></h1>
@stop

@section('content')
<h1>Criar perfil</h1>
<div class="card">

	<div class="card-body">
		<form action="{{route('profiles.store')}}" class="form" method="POST">
			@csrf

			@include('admin.pages.profiles._partials.form')

		</form>

	</div>
</div>

<div class="card-footer">

</div>
@stop