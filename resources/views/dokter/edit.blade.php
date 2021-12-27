@extends('template/home')
@section('judul','Edit Data Dokter')
@section('content')
    <form action="{{route('dokter.update',$dokter->id)}}" method="POST">
        @csrf
        @method('patch')
        <div class="form-group">
            <label>Nama Dokter</label>
            <input type="text" class="form-control" name="nama" value="{{$dokter->nama}}">
            @if($errors->has('nama'))
                <span class="text-danger">{{ $errors->first('nama') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label>Spesialis</label>
            <input type="text" class="form-control" name="spesialis" value="{{$dokter->spesialis}}">
            @if($errors->has('spesialis'))
                <span class="text-danger">{{ $errors->first('spesialis') }}</span>
            @endif
        </div>
        <div class="form-group">
            <button class="btn btn-success">Edit Dokter</button>
        </div>
    </form>
@endsection
