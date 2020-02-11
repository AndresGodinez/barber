@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset">
                <form action="{{ route('branches.store') }}" method="post">
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
                        <label for="address">Dirección</label>
                        <input type="text"
                               name="address"
                               id="address"
                               class="form-control"
                               placeholder="Dirección"
                               value="{{old('address')}}"
                               required>
                    </div>
                    <div class="form-group">
                        <label for="telephone">Teléfono</label>
                        <input type="text"
                               name="telephone"
                               id="telephone"
                               class="form-control"
                               placeholder="(81)..."
                               value="{{old('telephone')}}"
                               required>
                    </div>

                    <div class="form-group">
                        <label for="rfc">RFC</label>
                        <input type="text"
                               name="rfc"
                               id="rfc"
                               class="form-control"
                               placeholder="RFC"
                               value="{{old('rfc')}}"
                               required>
                    </div>

                    <button type="submit" class="btn btn-info text-white">Guardar</button>
                </form>
            </div>
        </div>
    </div>
@endsection