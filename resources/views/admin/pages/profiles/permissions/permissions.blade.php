@extends('adminlte::page')

@section('title', 'Permissões do perfil {$profile->name}')

@section('content_header')
    <h1>Permissões do perfil {{$profile->id}}<a href="{{route('profiles.permissions.available',$profile->id)}}" class="btn btn-dark">ADD</a></h1>

	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="{{route('profiles.index')}}">Perfis</a></li>
	</ol>
@stop

@section('content')
<h1>Lista de Permissões do Perfil</h1>

   <div class="card">
		<div class="card-header">


		<form action="{{route('profiles.search')}}" method="post" class="form form-inline" value="{{$searchs['search'] ?? ''}}">
			@csrf
			
				<input type="text" name="search" class="form-control" placeholder="Pesquisar profile">
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
								
								<a href="{{ route('profiles.permissions.detach', [$profile->id,$permission->id]) }}" class="btn btn-danger">Desvincular</a>
								
								<!-- <a href="{{ route('profiles.show', $permission->id) }}" class="btn btn-warning">Ver</a>

								<a href="{{ route('profiles.permissions', $permission->id) }}" class="btn btn-warning"><i class="fas fa-lock"></i> Permissões</a> -->
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