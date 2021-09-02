@extends('adminlte::page')

@section('title', 'Detalhe do Usuário')

@section('content_header')
    <h1>Detalhes do Usuário <a href="{{route('plans.index')}}" class="btn btn-dark">Voltar</a></h1>
@stop

@section('content')
<h1>Detalhes do  <b>{{$user->name}}</b></h1>
@include('admin.includes.alerts')
   <div class="card">
		
		<div class="card-body">
			<ul>
				<li>
					<strong>Nome:</strong> {{$user->name}}
				</li>
				<li>
					<strong>E-mail:</strong> {{$user->email}}
				</li>
				

				<li>
					<strong>Empresa:</strong> {{$user->tenant->name}}
				</li>
			</ul>

			<form action="{{route('users.destroy', $user->id)}}" method="POST">
			<!-- Quando o método for delete, tenho que fazer dessa forma sempre -->
				@csrf
				@method('DELETE')
				<button type="submit" class="btn btn-danger">Deletar</button>
			</form>
			
			
		</div>
   </div>

   <div class="card-footer">
		
   </div>
@stop