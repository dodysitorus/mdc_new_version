@extends('template/home')
@section('content')
    @foreach($dokter as $result)
        {{$result->nama}}
    @endforeach
@endsection
