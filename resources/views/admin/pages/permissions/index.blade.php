@extends('adminlte::page')

@section('title', 'Permissões')

@section('content_header')
    <h1>Permissões <a href="{{route('permissions.create')}}" class="btn btn-dark">ADD</a></h1>

	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="{{route('permissions.index')}}">Perfis</a></li>
	</ol>
@stop

@section('content')
<h1>Lista de Permissões</h1>

   <div class="card">
		<div class="card-header">


		<form action="{{route('permissions.search')}}" method="post" class="form form-inline" value="{{$searchs['search'] ?? ''}}">
			@csrf
			
				<input type="text" name="search" class="form-control" placeholder="Pesquisar permissions">
				<button type="submit" class="btn btn-dark">Pesquisar</button>
			
			
			
		</form>
		</div>
		<div class="card-body">
			<table class="table table-striped">
				<thead>
					<tr>
					<th>Nome</th>
					
					</tr>
				</thead>
				<tbody>
					@foreach ($permissions as $permission)
						<tr>
							<td>
								{{$permission->name}}
							</td>
							
							<td>

							
								
								<a href="{{ route('permissions.edit',$permission->id) }}" class="btn btn-info">Edit</a>
								
								<a href="{{ route('permissions.show', $permission->id) }}" class="btn btn-warning">Ver</a>

								<a href="{{ route('permissions.profile', $permission->id) }}" class="btn btn-dark">Perfis</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
   </div>

   <div class="card-footer">
   @if (isset($searchs))

   	{!! $permissions->appends($searchs)->links() !!}

   @else
	{!! $permissions->links() !!}
   @endif
		
   </div>
@stop