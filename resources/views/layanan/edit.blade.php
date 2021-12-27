@extends('template/home')
@section('judul','Edit Data Layanan')
@section('content')
    <form action="{{route('layanan.update',$layanan->id)}}" method="POST">
        @csrf
        @method('patch')
        <div class="form-group">
            <label>Nama layanan</label>
            <input type="text" class="form-control" name="nama" value="{{$layanan->nama}}">
            @if($errors->has('nama'))
                <span class="text-danger">{{ $errors->first('nama') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label>Harga</label>
            <input type="text" class="form-control" name="harga" value="{{$layanan->harga}}">
            @if($errors->has('harga'))
                <span class="text-danger">{{ $errors->first('harga') }}</span>
            @endif
        </div>
        <div class="form-group">
            <button class="btn btn-success">Edit harga</button>
        </div>
    </form>
@endsection
