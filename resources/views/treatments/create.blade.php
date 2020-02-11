@extends('layouts.myapp')
@section('content')
    <create-treatment></create-treatment>
@endsection
@section('scripts')
    <script src="{{ asset('js/create-treatment.js') }}" defer></script>
@endsection
