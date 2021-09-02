@extends('adminlte::page')

@section('title', 'Perfis')

@section('content_header')
    <h1>Perfis <a href="{{route('profiles.create')}}" class="btn btn-dark">ADD</a></h1>

	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="{{route('profiles.index')}}">Perfis</a></li>
	</ol>
@stop

@section('content')
<h1>Lista de Perfis</h1>

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
					@foreach ($profiles as $profile)
						<tr>
							<td>
								{{$profile->name}}
							</td>
							
							<td>

							
								
								<a href="{{ route('profiles.edit',$profile->id) }}" class="btn btn-info">Edit</a>
								
								<a href="{{ route('profiles.show', $profile->id) }}" class="btn btn-warning">Ver</a>

								<a href="{{ route('profiles.permissions', $profile->id) }}" class="btn btn-warning"><i class="fas fa-lock"></i> Permissões</a>
								<a href="{{ route('profiles.plans', $profile->id) }}" class="btn btn-warning"><i class="fas fa-lock"></i> </a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
   </div>

   <div class="card-footer">
   @if (isset($searchs))

   	{!! $profiles->appends($searchs)->links() !!}

   @else
	{!! $profiles->links() !!}
   @endif
		
   </div>
@stop