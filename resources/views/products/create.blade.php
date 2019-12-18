@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset">
                <form action="{{ route('products.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text"
                               name="name"
                               id="name"
                               class="form-control"
                               placeholder="Nombre"
                               value="{{old('name')}}"
                               required>
                    </div>

                    <div class="form-group">
                        <label for="code">Código Interno</label>
                        <input type="text"
                               name="code"
                               id="code"
                               class="form-control"
                               placeholder="Código"
                               value="{{old('code')}}"
                               required>
                    </div>
                    <div class="form-group">
                        <label for="cost">Costo</label>
                        <input type="text"
                               name="cost"
                               id="cost"
                               class="form-control"
                               placeholder="$0.00"
                               value="{{old('cost')}}"
                               required>
                    </div>

                    <div class="form-group">
                        <label for="sale_price">Precio Venta</label>
                        <input type="text"
                               name="sale_price"
                               id="sale_price"
                               class="form-control"
                               placeholder="$0.00"
                               value="{{old('sale_price')}}"
                               required>
                    </div>

                    <button type="submit" class="btn btn-info text-white">Guardar</button>
                </form>
            </div>
        </div>
    </div>
@endsection