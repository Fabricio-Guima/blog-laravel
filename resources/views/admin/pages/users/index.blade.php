@extends('adminlte::page')

@section('title', 'Usuários')

@section('content_header')
    <h1>Usuários <a href="{{route('users.create')}}" class="btn btn-dark">ADD</a></h1>

	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="{{route('users.index')}}">Usuários</a></li>
	</ol>
@stop

@section('content')
<h1>Lista de usuários</h1>

   <div class="card">
		<div class="card-header">


		<form action="{{route('users.search')}}" method="post" class="form form-inline" value="{{$searchs['search'] ?? ''}}">
			@csrf
			
				<input type="text" name="search" class="form-control" placeholder="Pesquisar plano">
				<button type="submit" class="btn btn-dark">Pesquisar</button>
			
			
			
		</form>
		</div>
		<div class="card-body">
			<table class="table table-striped">
				<thead>
					<tr>
					<th>Nome</th>
					<th>E-mail</th>
					<th>Ações</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($users as $user)
						<tr>
							<td>
								{{$user->name}}
							</td>
							<td>
								{{$user->email}}
							</td>
							
							<td>								
								
								<a href="{{ route('users.edit',$user->id) }}" class="btn btn-info">Edit</a>
								
								<a href="{{ route('users.show', $user->id) }}" class="btn btn-warning">Ver</a>

								<a href="{{ route('users.roles', $user->id) }}" title="Cargos" class="btn btn-warning"> <i class="fas fa-address-card"></i> </a>

								
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
   </div>

   <div class="card-footer">
   @if (isset($searchs))

   	{!! $users->appends($searchs)->links() !!}

   @else
	{!! $users->links() !!}
   @endif
		
   </div>
@stop