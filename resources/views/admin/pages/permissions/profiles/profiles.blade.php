@extends('adminlte::page')

@section('title', "Perfis da permissão {$permission->name}")

@section('content_header')
    <h1>Permissão {{$permission->name}}</h1>

	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="{{route('permissions.index')}}">Perfis</a></li>
	</ol>

	@include('admin.includes.alerts')

@stop

@section('content')
<h1>Lista de Perfis disponíveis da Permissão</h1>

   <div class="card">
		<div class="card-header">

		
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
				
						@foreach ($profiles as $profile)
							<tr>
								
								<td>
									{{$profile->name}}
								</td>	
							</tr>
						@endforeach

						<tr>
							<td colspan="500">
							<button type="submit" class="btn btn-success">Vincular</button>
							</td>
						</tr>
					
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