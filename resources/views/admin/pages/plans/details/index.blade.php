@extends('adminlte::page')

@section('title', 'Detalhes do plano')

@section('content_header')
   

	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="{{route('plans.index')}}">Planos</a></li>
		<li class="breadcrumb-item"><a href="{{route('plans.show', $plan->url)}}">{{$plan->name}}</a></li>
		<li class="breadcrumb-item"><a href="{{route('details.plan.index', $plan->url)}}">Detalhes</a></li>
		
	</ol>

	 <h1>Detalhes<a href="{{ route('details.plan.create', $plan->url) }}" class="btn btn-dark">ADD</a></h1>
	 
@stop

@section('content')
<h1>Detalhes do plano <b>{{ $plan->name }}</b> </h1>
   <div class="card">
		<div class="card-header">
		
		</div>
		<div class="card-body">
		@include('admin.includes.alerts')
			<table class="table table-striped">
				<thead>
					<tr>
					<th>Nome</th>					
					<th>Ações</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($details as $detail)
						<tr>
							<td>
								{{$detail->name}}
								
							</td>
							
							<td>
								<a href="{{ route('details.plan.edit',  [$plan->url, $detail->id]) }}" class="btn btn-info">Edit</a>
								
								<a href="{{ route('details.plan.show', [$plan->url, $detail->id]) }}" class="btn btn-warning">Ver</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
   </div>

   <div class="card-footer">
   @if (isset($searchs))

   	{!! $details->appends($searchs)->links() !!}

   @else
	{!! $details->links() !!}
   @endif
		
   </div>
@stop