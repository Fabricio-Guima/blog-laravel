@extends('adminlte::page')

@section('title', 'Editar Perfil')

@section('content_header')
    <h1>Editar Perfil <a href="{{route('profiles.index')}}" class="btn btn-dark">Voltar</a></h1>
@stop

@section('content')
<h1>Editar Perfil</h1>
   <div class="card">
		
		<div class="card-body">
			<form action="{{route('profiles.update', $profile->id)}}" class="form" method="post">
				@csrf
				@method('PUT')

				@include('admin.pages.profiles._partials.form')

			</form>
			
		</div>
   </div>

   <div class="card-footer">
		
   </div>
@stop