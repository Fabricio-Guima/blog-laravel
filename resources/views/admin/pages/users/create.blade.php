@extends('adminlte::page')

@section('title', 'Cadastrar Usuário')

@section('content_header')
    <h1>Cadatrar Novo Usuário <a href="{{route('users.index')}}" class="btn btn-dark">Voltar</a></h1>
@stop

@section('content')
<h1>Criar usuário</h1>
   <div class="card">
		
		<div class="card-body">
			<form action="{{route('users.store')}}" class="form" method="post">
				@csrf

				@include('admin.pages.users._partials.form')

			</form>
			
		</div>
   </div>

   <div class="card-footer">
		
   </div>
@stop