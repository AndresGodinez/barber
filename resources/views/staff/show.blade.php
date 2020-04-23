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
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$staff->name}}</td>
                                    <td>{{$staff->username}}</td>
                                    <td>{{$staff->branch->name}}</td>
                                    <td>{{$staff->commission}}</td>
                                    <td><a href="{{route('staff.edit', ['staff' => $staff->id])}}">Editar</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection