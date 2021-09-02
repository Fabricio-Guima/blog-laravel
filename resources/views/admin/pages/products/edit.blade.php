@extends('adminlte::page')

@section('title', 'Editar Produto')

@section('content_header')
    <h1>Editar Produto <a href="{{route('products.index')}}" class="btn btn-dark">Voltar</a></h1>
@stop

@section('content')
<h1>Editar Produto</h1>
   <div class="card">
		
		<div class="card-body">
			
			<form action="{{route('products.update', $product->id)}}" class="form" method="post" enctype="multipart/form-data">
				@csrf
				@method('PUT')

				<div class="form-group">
					<label for="name">Nome:</label>
					<input type="text "name="name" class="form-control" placeholder="Nome" value="{{$product->name}}">
				</div>

				<div class="form-group">
   					 <label>* Preço:</label>
   					 <input type="text" name="price" class="form-control" placeholder="Preço:" value="{{ $product->price ?? old('price') }}">
				</div>

				<div class="form-group">
    				<label>* Imagem:</label>
    				<input type="file" name="image" class="form-control">
				</div>

				<div class="form-group">
					<label for="name">Descrição:</label>
				<textarea name="description" id="" cols="30" rows="5"  class="form-control">{{$product->description}}
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