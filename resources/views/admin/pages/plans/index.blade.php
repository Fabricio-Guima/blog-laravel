@extends('adminlte::page')

@section('title', 'Planos')

@section('content_header')
    <h1>Planos <a href="{{route('plans.create')}}" class="btn btn-dark">ADD</a></h1>

	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="{{route('plans.index')}}">Planos</a></li>
	</ol>
@stop

@section('content')
<h1>Lista de plano</h1>

   <div class="card">
		<div class="card-header">


		<form action="{{route('plans.search')}}" method="post" class="form form-inline" value="{{$searchs['search'] ?? ''}}">
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
					<th>Preço</th>
					<th>Ações</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($plans as $plan)
						<tr>
							<td>
								{{$plan->name}}
							</td>
							<td>
								R$ {{number_format($plan->price, 2, ',', '.')}}
							</td>
							<td>

								<a href="{{ route('details.plan.index', $plan->url) }}" class="btn btn-primary">Detalhes</a>
								
								<a href="{{ route('plans.edit',$plan->url) }}" class="btn btn-info">Edit</a>
								
								<a href="{{ route('plans.show', $plan->url) }}" class="btn btn-warning">Ver</a>

								<a href="{{ route('plans.profiles', $plan->id) }}" class="btn btn-warning"><i class="fas fa-address-book"></i></a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
   </div>

   <div class="card-footer">
   @if (isset($searchs))

   	{!! $plans->appends($searchs)->links() !!}

   @else
	{!! $plans->links() !!}
   @endif
		
   </div>
@stop