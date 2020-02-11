@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset">
                <table class="table table-striped">
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Dirección</th>
                        <th>RFC</th>
                    </tr>
                    <tr>
                        <td>{{$branch->id}}</td>
                        <td>{{$branch->name}}</td>
                        <td>{{$branch->telephone}}</td>
                        <td>{{$branch->address}}</td>
                        <td>{{$branch->rfc}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection