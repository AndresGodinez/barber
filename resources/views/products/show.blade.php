@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset">
                <table class="table table-striped">
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Código</th>
                        <th>Costo</th>
                        <th>Precio</th>
                    </tr>
                    <tr>
                        <td>{{$product->id}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->code}}</td>
                        <td>{{$product->cost}}</td>
                        <td>{{$product->sale_price}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection