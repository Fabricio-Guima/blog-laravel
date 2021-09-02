@extends('adminlte::page')

@section('title', 'Cadastrar Produto')

@section('content_header')
    <h1>Cadatrar Novo Produto <a href="{{route('admin.index')}}" class="btn btn-dark">Voltar</a></h1>
@stop

@section('content')
<h1>Criar Produto</h1>
   <div class="card">
		
		<div class="card-body">
			<form action="{{route('products.store')}}" class="form" method="post" 
			enctype="multipart/form-data">
				@csrf

				@include('admin.pages.products._partials.form')

			</form>
			
		</div>
   </div>

   <div class="card-footer">
		
   </div>
@stop