@extends('layouts.app')
@include('partials.errors')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset">
                <form action="{{ route('products.update', ['product' => $product->id ]) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text"
                               name="name"
                               id="name"
                               class="form-control"
                               placeholder="Nombre"
                               value="{{$product->name}}"
                               required>
                    </div>

                    <div class="form-group">
                        <label for="code">Código Interno</label>
                        <input type="text"
                               name="code"
                               id="code"
                               class="form-control"
                               placeholder="Código"
                               value="{{$product->code}}"
                               required>
                    </div>
                    <div class="form-group">
                        <label for="cost">Costo</label>
                        <input type="text"
                               name="cost"
                               id="cost"
                               class="form-control"
                               placeholder="$0.00"
                               value="{{$product->cost}}"
                               required>
                    </div>

                    <div class="form-group">
                        <label for="sale_price">Precio Venta</label>
                        <input type="text"
                               name="sale_price"
                               id="sale_price"
                               class="form-control"
                               placeholder="$0.00"
                               value="{{$product->sale_price}}"
                               required>
                    </div>

                    <button type="submit" class="btn btn-info text-white">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
@endsection