@extends('adminlte::page')

@section('title', 'Detalhe do Plano')

@section('content_header')
    <h1>Detalhes do Plano <a href="{{route('plans.index')}}" class="btn btn-dark">Voltar</a></h1>
@stop

@section('content')
<h1>Detalhes do  <b>{{$plan->name}}</b></h1>
@include('admin.includes.alerts')
   <div class="card">
		
		<div class="card-body">
			<ul>
				<li>
					<strong>Nome:</strong> {{$plan->name}}
				</li>
				<li>
					<strong>URL:</strong> {{$plan->url}}
				</li>
				<li>
					<strong>Preço:</strong> R${{number_format($plan->price, 2, ',', '.')}}
				</li>

				<li>
					<strong>description:</strong> {{$plan->description}}
				</li>
			</ul>

			<form action="{{route('plans.destroy', $plan->url)}}" method="POST">
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