@extends('adminlte::page')

@section('title', 'Cadastrar Categoria')

@section('content_header')
    <h1>Cadatrar Nova categoria <a href="{{route('users.index')}}" class="btn btn-dark">Voltar</a></h1>
@stop

@section('content')
<h1>Criar usuário</h1>
   <div class="card">
		
		<div class="card-body">
			<form action="{{route('categories.store')}}" class="form" method="post">
				@csrf

				@include('admin.pages.categories._partials.form')

			</form>
			
		</div>
   </div>

   <div class="card-footer">
		
   </div>
@stop