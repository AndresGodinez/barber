@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('partials.search-form')
            <div class="col-md-12 mb-2">
                <a href="{{route('products.create')}}" class="btn btn-info text-white float-lg-right">
                    Nuevo Producto
                </a>
            </div>
            <div class="col-md-12">
                <table class="table table-striped">
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Código Interno</th>
                        <th>Costo</th>
                        <th>Precio Publico</th>
                        <th>Acciones</th>
                    </tr>
                    @foreach($products as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td>
                                <a href="{{route('products.show', ['product' => $product->id])}}">
                                    {{$product->name}}
                                </a>
                            </td>
                            <td>{{$product->code}}</td>
                            <td>{{$product->cost}}</td>
                            <td>{{$product->sale_price}}</td>
                            <td>
                                <a href="{{route('products.edit', ['product' => $product->id])}}"
                                   class="btn btn-info text-white">
                                    Editar
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div class="row">
            {{ $products->render() }}
        </div>
    </div>
@endsection