@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset">
                <form action="{{ route('units.store') }}" method="post">
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
                    sale_piece
                    <div class="form-group">
                        <label for="code">Código SAT</label>
                        <input type="text"
                               name="sat_code"
                               id="sat_code"
                               class="form-control"
                               placeholder="Código"
                               value="{{old('sat_code')}}"
                               required>
                    </div>

                    <div class="form-group">
                        <label for="sale_price">Precio Venta</label>
                        <input type="checkbox"
                               name="sale_piece"
                               id="sale_piece"
                               class="form-check"
                               value="{{old('sale_piece')}}"
                               required>
                    </div>

                    <button type="submit" class="btn btn-info text-white">Guardar</button>
                </form>
            </div>
        </div>
    </div>
@endsection