@extends('adminlte::page')

@section('title', 'Detalhe d Permissão')

@section('content_header')
    <h1>Detalhes da Permissão <a href="{{route('permissions.index')}}" class="btn btn-dark">Voltar</a></h1>
@stop

@section('content')
<h1>Detalhes do  <b>{{$permission->name}}</b></h1>
@include('admin.includes.alerts')
   <div class="card">
		
		<div class="card-body">
			<ul>
				<li>
					<strong>Nome:</strong> {{$permission->name}}
				</li>				

				<li>
					<strong>Descrição:</strong> {{$permission->description}}
				</li>
			</ul>

			<form action="{{route('permissions.destroy', $permission->id)}}" method="POST">
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