@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="car-header h5">{{$customer->name}}</div>
                    <div class="card-body">
                        {{$customer->name}}
                        {{$customer->email}}
                        {{$customer->telephone}}
                        {{$customer->active}}
                        {{$customer->expiration}}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection