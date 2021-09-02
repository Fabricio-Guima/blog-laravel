@extends('adminlte::page')

@section('title', "Categorias do produto {$product->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Produtos</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('products.categories', $product->id) }}" class="active">Perfis</a></li>
    </ol>

    <h1>Categorias do produto <strong>{{ $product->name }}</strong></h1>

    <a href="{{ route('products.categories.available', $product->id) }}" class="btn btn-dark">ADD Nova Categoria</a>

@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th width="50">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>
                                {{ $category->name }}
                            </td>
                            <td>
                                <a href="{{ route('products.category.detach', [$product->id, $category->id]) }}" class="btn btn-danger">DESVINCULAR</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($searchs))
                {!! $categories->appends($searchs)->links() !!}
            @else
                {!! $categories->links() !!}
            @endif
        </div>
    </div>
@stop