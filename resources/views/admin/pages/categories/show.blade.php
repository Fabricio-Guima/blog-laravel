@extends('adminlte::page')

@section('title', 'Detalhe da Categoria')

@section('content_header')
    <h1>Detalhes da Categoria <a href="{{route('categories.index')}}" class="btn btn-dark">Voltar</a></h1>
@stop

@section('content')
<h1>Detalhes do  <b>{{$category->name}}</b></h1>
@include('admin.includes.alerts')
   <div class="card">
		
		<div class="card-body">
			<ul>
				<li>
					<strong>Nome:</strong> {{$category->name}}
				</li>
				<li>
					<strong>URL:</strong> {{$category->url}}
				</li>
				

				<li>
					<strong>Descrição:</strong> {{$category->description}}
				</li>
			</ul>

			<form action="{{route('categories.destroy', $category->id)}}" method="POST">
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