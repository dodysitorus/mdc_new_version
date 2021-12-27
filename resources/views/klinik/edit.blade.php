@extends('template/home')
@section('judul','Edit Data Klinik')
@section('content')
    <form action="{{route('klinik.update',$klinik->id)}}" method="POST">
        @csrf
        @method('patch')
        <div class="form-group">
            <label>Nama Klinik</label>
            <input type="text" class="form-control" name="nama" value="{{$klinik->nama}}">
            @if($errors->has('nama'))
                <span class="text-danger">{{ $errors->first('nama') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label>Alamat Klinik</label>
            <input type="text" class="form-control" name="alamat" value="{{$klinik->alamat}}">
            @if($errors->has('alamat'))
                <span class="text-danger">{{ $errors->first('alamat') }}</span>
            @endif
        </div>
        <div class="form-group">
            <button class="btn btn-success">Edit Klinik</button>
        </div>
    </form>
@endsection
