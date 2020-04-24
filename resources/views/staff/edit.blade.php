@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header h5">Personal</div>
                    <div class="card-body">
                        <form action="{{route('staff.update', ['staff' => $staff->id])}}" method="post">
                            @method('PUT')
                            @csrf
                            <div class="form-row">
                                <div class="form group col-md-6">
                                    <label for="name">Nombre</label>
                                    <input type="text" name="name" id="name" value="{{$staff->name}}">
                                </div>
                                <div class="form group col-md-6">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" id="username" value="{{$staff->username}}">
                                </div>
                            </div>

                            <div class="form-row">

                                <div class="form group col-md-6">
                                    <label for="branch_id">Sucursal</label>
                                    <select name="branch_id" id="branch_id">
                                        @foreach($branches as $branch)
                                            <option value="{{ $branch->id }}"
                                                    {{$branch->id == $staff->branch->id ? 'selected' : ''}}>
                                                {{$branch->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form group col-md-6">
                                    <label for="commission">Comisión</label>
                                    <input type="text" name="commission" id="commission" value="{{$staff->commission}}">
                                </div>
                            </div>

                            <div class="form-row">

                                <div class="form group col-md-6">
                                    <input type="submit" value="Actualizar">
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection