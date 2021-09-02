@extends('adminlte::page')

@section('title', 'Produtos')

@section('content_header')
    <h1>Produtos <a href="{{route('products.create')}}" class="btn btn-dark">ADD</a></h1>

	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="{{route('products.index')}}">Produtos</a></li>
	</ol>
@stop

@section('content')
<h1>Lista de produtos</h1>

   <div class="card">
		<div class="card-header">


		<form action="{{route('products.search')}}" method="post" class="form form-inline" value="{{$searchs['search'] ?? ''}}">
			@csrf
			
				<input type="text" name="search" class="form-control" placeholder="Pesquisar produtos">
				<button type="submit" class="btn btn-dark">Pesquisar</button>
			
			
			
		</form>
		</div>
		<div class="card-body">
			<table class="table table-striped">
				<thead>
					<tr>
					<th>Imagem</th>

					<th>Nome</th>
					
					<th>Ações</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($products as $product)
						<tr>
							<td>
								<img width="100" src="{{url("storage/{$product->image}")}}" alt="">
								
							</td>
							<td>
								{{$product->name}}
							</td>							
							
							<td>
								<a href="{{ route('products.categories',$product->id) }}" class="btn btn-warning" title="Categoria"><i class="fas fa-layer-group"></i></a>								
								
								<a href="{{ route('products.edit',$product->id) }}" class="btn btn-info">Edit</a>
								
								<a href="{{ route('products.show', $product->id) }}" class="btn btn-warning">Ver</a>

								
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
   </div>

   <div class="card-footer">
   @if (isset($searchs))

   	{!! $products->appends($searchs)->links() !!}

   @else
	{!! $products->links() !!}
   @endif
		
   </div>
@stop