@extends('adminlte::page')

@section('title', "Permissões disponíveis do perfil {$profile->name}")

@section('content_header')
    <h1>Permissões do perfil {{$profile->name}}</h1>

	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="{{route('profiles.index')}}">Perfis</a></li>
	</ol>

	@include('admin.includes.alerts')

@stop

@section('content')
<h1>Lista de Permissões disponíveis do Perfil</h1>

   <div class="card">
		<div class="card-header">


		<form action="{{route('profiles.permissions.available', $profile->id)}}" method="post" class="form form-inline" value="{{$searchs['search'] ?? ''}}">
			@csrf
			
				<input type="text" name="search" class="form-control" placeholder="Pesquisar profile">
				<button type="submit" class="btn btn-dark">Pesquisar</button>
			
			
			
		</form>
		</div>
		<div class="card-body">
			<table class="table table-striped">
				<thead>
					<tr>
					<th width="50px">#</th>
					<th>Nome</th>
					
					</tr>
				</thead>
				<tbody>
					<form action="{{route('profiles.permissions.attach', $profile->id)}}" method="POST">
					@csrf
					
						@foreach ($permissions as $permission)
							<tr>
								<td>
									 <input type="checkbox" name="permissions[]" value="{{ $permission->id }}">
									
								</td>

								<td>
									{{$permission->name}}
								</td>	
							</tr>
						@endforeach

						<tr>
							<td colspan="500">
							<button type="submit" class="btn btn-success">Vincular</button>
							</td>
						</tr>
					</form>
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