@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header h5">Personal</div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Usuario</th>
                                <th>Sucursal</th>
                                <th>Comision</th>
                                <th colspan="2">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($staff as $person)
                                <tr>
                                    <td>{{$person->name}}</td>
                                    <td>{{$person->username}}</td>
                                    <td>{{$person->branch->name}}</td>
                                    <td>{{$person->commission}}</td>
                                    <td><a href="{{route('staff.show', ['staff' => $person->id])}}">Detalles</a></td>
                                    <td><a href="{{route('staff.edit', ['staff' => $person->id])}}">Editar</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection