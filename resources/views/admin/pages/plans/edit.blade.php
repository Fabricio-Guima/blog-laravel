@extends('adminlte::page')

@section('title', 'Editar Plano')

@section('content_header')
    <h1>Editar Plano <a href="{{route('plans.index')}}" class="btn btn-dark">Voltar</a></h1>
@stop

@section('content')
<h1>Editar plano</h1>
   <div class="card">
		
		<div class="card-body">
			<form action="{{route('plans.update', $plan->url)}}" class="form" method="post">
				@csrf
				@method('PUT')

				<div class="form-group">
					<label for="name">Nome:</label>
					<input type="text "name="name" class="form-control" placeholder="Nome" value="{{$plan->name}}">
				</div>

				<div class="form-group">
					<label for="name">Preço:</label>
					<input type="number "name="price" class="form-control" placeholder="Preço" value="{{$plan->price}}">
				</div>

				<div class="form-group">
					<label for="description">Descrição:</label>
					<textarea class="form-control" name="description" id="description" cols="30" rows="10">{{$plan->description}}</textarea>
				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-dark">Enviar</button>
				</div>

			</form>
			
		</div>
   </div>

   <div class="card-footer">
		
   </div>
@stop