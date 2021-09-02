@extends('adminlte::page')

@section('title', 'Detalhes do Produto')

@section('content_header')
    <h1>Detalhes do Produto <a href="{{route('products.index')}}" class="btn btn-dark">Voltar</a></h1>
@stop

@section('content')
<h1>Detalhes do  <b>{{$product->name}}</b></h1>
@include('admin.includes.alerts')
   <div class="card">
		
		<div class="card-body">
			<ul>
				<li>
					<img width="90" src="{{url("storage/{$product->image}")}}" alt="">
				</li>
				<li>
					<strong>Nome:</strong> {{$product->name}}
				</li>
				<li>
					<strong>URL:</strong> {{$product->url}}
				</li>
				

				<li>
					<strong>Descrição:</strong> {{$product->description}}
				</li>
			</ul>

			<form action="{{route('products.destroy', $product->id)}}" method="POST">
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