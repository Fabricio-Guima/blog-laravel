@extends('adminlte::page')

@section('title', 'Detalhe do Perfil')

@section('content_header')
    <h1>Detalhes do Perfil <a href="{{route('plans.index')}}" class="btn btn-dark">Voltar</a></h1>
@stop

@section('content')
<h1>Detalhes do  <b>{{$profile->name}}</b></h1>
@include('admin.includes.alerts')
   <div class="card">
		
		<div class="card-body">
			<ul>
				<li>
					<strong>Nome:</strong> {{$profile->name}}
				</li>				

				<li>
					<strong>Descrição:</strong> {{$profile->description}}
				</li>
			</ul>

			<form action="{{route('profiles.destroy', $profile->id)}}" method="POST">
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