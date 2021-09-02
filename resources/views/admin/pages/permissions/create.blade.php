@extends('adminlte::page')

@section('title', 'Cadastrar Permissão')

@section('content_header')
<h1>Cadatrar Nova Permissão <a href="{{route('permissions.store')}}" class="btn btn-dark">Voltar</a></h1>
@stop

@section('content')
<h1>Criar Permissão</h1>
<div class="card">

	<div class="card-body">
		<form action="{{route('permissions.store')}}" class="form" method="POST">
			@csrf

			@include('admin.pages.permissions._partials.form')

		</form>

	</div>
</div>

<div class="card-footer">

</div>
@stop