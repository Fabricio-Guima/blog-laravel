@extends('adminlte::page')

@section('title', 'Cadastrar Plano')

@section('content_header')
    <h1>Cadatrar Novo Plano <a href="{{route('plans.index')}}" class="btn btn-dark">Voltar</a></h1>
@stop

@section('content')
<h1>Criar plano</h1>
   <div class="card">
		
		<div class="card-body">
			<form action="{{route('plans.store')}}" class="form" method="post">
				@csrf

				@include('admin.pages.plans._partials.form')

			</form>
			
		</div>
   </div>

   <div class="card-footer">
		
   </div>
@stop