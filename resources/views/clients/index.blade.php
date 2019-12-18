@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('partials.search-form')
            <div class="col-md-12">
                <table class="table table-striped">
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th colspan="2">Acciones</th>
                    </tr>
                    @foreach($clients as $client)
                        <tr>
                            <td>{{$client->id}}</td>
                            <td>{{$client->name}}</td>
                            <td>{{$client->address}}</td>
                            <td>{{$client->phone}}</td>
                            <td><a href="#">Detalles</a></td>
                            <td><a href="#">Editar</a></td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div class="row">
            {{ $clients->render() }}
        </div>
    </div>
@endsection