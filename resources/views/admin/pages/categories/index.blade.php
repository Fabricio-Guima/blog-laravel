@extends('adminlte::page')

@section('title', 'Categorias')

@section('content_header')
    <h1>Categorias
		@can('add_cat')
		<a href="{{route('categories.create')}}" class="btn btn-dark">ADD</a></h1>
			
		@endcan	

	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="{{route('categories.index')}}">Categorias</a></li>
	</ol>
@stop

@section('content')
<h1>Lista de categorias</h1>

   <div class="card">
		<div class="card-header">


		<form action="{{route('categories.search')}}" method="post" class="form form-inline" value="{{$searchs['search'] ?? ''}}">
			@csrf
			
				<input type="text" name="search" class="form-control" placeholder="Pesquisar categoria">
				<button type="submit" class="btn btn-dark">Pesquisar</button>
			
			
			
		</form>
		</div>
		<div class="card-body">
			<table class="table table-striped">
				<thead>
					<tr>
					<th>Nome</th>
					
					<th>descrição</th>

					<th>Ações</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($categories as $category)
						<tr>
							<td>
								{{$category->name}}
							</td>
							<td>
								{{$category->description}}
							</td>
							
							<td>								
								
								<a href="{{ route('categories.edit',$category->id) }}" class="btn btn-info">Edit</a>
								
								<a href="{{ route('categories.show', $category->id) }}" class="btn btn-warning">Ver</a>

								
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
   </div>

   <div class="card-footer">
   @if (isset($searchs))

   	{!! $categories->appends($searchs)->links() !!}

   @else
	{!! $categories->links() !!}
   @endif
		
   </div>
@stop