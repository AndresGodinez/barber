@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="{{route('customer.store')}}" method="post">
                    @csrf
                    <div class="form-row">
                        <div class=" col-md-6">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>

                        <div class=" col-md-6">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" id="last_name" class="form-control">
                        </div>

                    </div>

                    <div class="form-row">
                        <div class=" col-md-6">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control">
                        </div>

                    </div>

                    <div class="form-row">
                        <div class=" col-md-6">
                            <label for="telephone">Telephone</label>
                            <input type="text" name="telephone" id="telephone" class="form-control">
                        </div>

                        <div class=" col-md-6">
                            <label for="type">Type</label>
                            <select name="type_id" id="type" class="form-control">
                                @foreach($types as $type)
                                <option value="{{ $type->id }}">{{$type->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-row mt-4">
                        <div class=" col-md-6">
                            <input type="submit"  class="btn btn-primary" value="Send">
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
