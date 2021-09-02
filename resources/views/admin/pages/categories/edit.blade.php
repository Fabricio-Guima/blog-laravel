@extends('adminlte::page')

@section('title', 'Editar Categoria')

@section('content_header')
    <h1>Editar Categoria <a href="{{route('categories.index')}}" class="btn btn-dark">Voltar</a></h1>
@stop

@section('content')
<h1>Editar Usuário</h1>
   <div class="card">
		
		<div class="card-body">
			
			<form action="{{route('categories.update', $category->id)}}" class="form" method="post">
				@csrf
				@method('PUT')

				<div class="form-group">
					<label for="name">Nome:</label>
					<input type="text "name="name" class="form-control" placeholder="Nome" value="{{$category->name}}">
				</div>

				<div class="form-group">
					<label for="name">Descrição:</label>
				<textarea name="description" id="" cols="30" rows="5"  class="form-control">{{$category->description}}
				</textarea>
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