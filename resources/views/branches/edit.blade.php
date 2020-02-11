@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset">
                <form action="{{ route('branches.update', ['branch' => $branch->id]) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text"
                               name="name"
                               id="name"
                               class="form-control"
                               placeholder="Nombre"
                               value="{{$branch->name}}"
                               required>
                    </div>

                    <div class="form-group">
                        <label for="telephone">Teléfono</label>
                        <input type="text"
                               name="telephone"
                               id="telephone"
                               class="form-control"
                               placeholder="(81)..."
                               value="{{$branch->telephone}}"
                               required>
                    </div>
                    <div class="form-group">
                        <label for="address">Dirección</label>
                        <input type="text"
                               name="address"
                               id="address"
                               class="form-control"
                               placeholder="$0.00"
                               value="{{$branch->address}}"
                               required>
                    </div>

                    <div class="form-group">
                        <label for="rfc">RFC</label>
                        <input type="text"
                               name="rfc"
                               id="rfc"
                               class="form-control"
                               placeholder="$0.00"
                               value="{{$branch->rfc}}"
                               required>
                    </div>

                    <button type="submit" class="btn btn-info text-white">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
@endsection