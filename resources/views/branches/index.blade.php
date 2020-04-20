@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('partials.search-form')
            <div class="col-md-12 mb-2">
                <a href="{{route('branches.create')}}" class="btn btn-info text-white float-lg-right">
                    Nueva Sucursal
                </a>
            </div>
            <div class="col-md-12">
                <table class="table table-striped">
                    <tr>
                        <th>Id</th>
                        <th>User</th>
                        <th>Nombre</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>RFC</th>
                        <th>Acciones</th>
                    </tr>
                    @foreach($branches as $branch)
                        <tr>
                            <td>{{$branch->id}}</td>
                            <td>{{$branch->user->name}}</td>
                            <td>
                                <a href="{{route('branches.show', ['branch' => $branch->id])}}">
                                    {{$branch->name}}
                                </a>
                            </td>
                            <td>{{$branch->telephone}}</td>
                            <td>{{$branch->address}}</td>
                            <td>{{$branch->rfc}}</td>
                            <td>
                                <a href="{{route('branches.edit', ['branch' => $branch->id])}}"
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
            {{ $branches->render() }}
        </div>
    </div>
@endsection