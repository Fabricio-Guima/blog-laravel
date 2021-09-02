@extends('adminlte::page')

@section('title', 'Editar Permissão')

@section('content_header')
    <h1>Editar Permissão <a href="{{route('permissions.index')}}" class="btn btn-dark">Voltar</a></h1>
@stop

@section('content')
<h1>Editar Permissão</h1>
   <div class="card">
		
		<div class="card-body">
			<form action="{{route('permissions.update', $permission->id)}}" class="form" method="post">
				@csrf
				@method('PUT')

				@include('admin.pages.permissions._partials.form')

			</form>
			
		</div>
   </div>

   <div class="card-footer">
		
   </div>
@stop