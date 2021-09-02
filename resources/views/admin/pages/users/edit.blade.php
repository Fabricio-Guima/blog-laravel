@extends('adminlte::page')

@section('title', 'Editar Usuário')

@section('content_header')
    <h1>Editar Usuário <a href="{{route('users.index')}}" class="btn btn-dark">Voltar</a></h1>
@stop

@section('content')
<h1>Editar Usuário</h1>
   <div class="card">
		
		<div class="card-body">
			
			<form action="{{route('users.update', $user->id)}}" class="form" method="post">
				@csrf
				@method('PUT')

				<div class="form-group">
					<label for="name">Nome:</label>
					<input type="text "name="name" class="form-control" placeholder="Nome" value="{{$user->name}}">
				</div>

				<div class="form-group">
					<label for="name">E-mail:</label>
					<input type="email "name="email" class="form-control" placeholder="E-mail" value="{{$user->email}}">
				</div>

				<div class="form-group">
					<label for="password">Senha:</label>
					<input type="password "name="password" class="form-control" placeholder="Senha"">
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