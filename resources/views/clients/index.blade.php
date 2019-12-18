@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('partials.search-form')
            <div class="col-md-12 mb-2">
                <a href="{{route('clients.create')}}" class="btn btn-info text-white float-lg-right">
                    Nuevo Cliente
                </a>
            </div>
            <div class="col-md-12">
                <table class="table table-striped">
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Acciones</th>
                    </tr>
                    @foreach($clients as $client)
                        <tr>
                            <td>{{$client->id}}</td>
                            <td>
                                <a href="{{route('clients.show', ['client' => $client->id])}}">
                                    {{$client->name}}
                                </a>
                            </td>
                            <td>{{$client->telephone}}</td>
                            <td>{{$client->email}}</td>
                            <td>
                                <a href="{{route('clients.edit', ['client' => $client->id])}}"
                                        class="btn btn-info text-white">
                                    Editar
                                </a>
                            </td>
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