@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset">
                <form action="{{ route('clients.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text"
                               name="name"
                               id="name"
                               class="form-control"
                               placeholder="nombre"
                               value="{{old('name')}}"
                               required>
                    </div>
                    <div class="form-group">
                        <label for="telephone">Teléfono</label>
                        <input type="text"
                               name="telephone"
                               id="telephone"
                               class="form-control"
                               placeholder="nombre"
                               value="{{old('telephone')}}"
                               required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email"
                               name="email"
                               id="email"
                               class="form-control"
                               placeholder="email"
                               value="{{old('email')}}"
                               required>
                    </div>

                    <button type="submit" class="btn btn-info text-white">Guardar</button>
                </form>
            </div>
        </div>
    </div>
@endsection