@extends('template/home')
@section('judul','Tambah Data Layanan')
@section('content')
    <form action="{{route('layanan.store')}}" method="POST">
        @csrf
        <div class="form-group">
            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                    @php
                        Session::forget('success')
                    @endphp
                </div>
            @endif
            <label>Nama Layanan</label>
            <input type="text" class="form-control" name="nama">
            @if($errors->has('nama'))
                <span class="text-danger">{{ $errors->first('nama') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label>Harga</label>
            <input type="text" class="form-control" name="harga">
            @if($errors->has('harga'))
                <span class="text-danger">{{ $errors->first('harga') }}</span>
            @endif
        </div>
        <div class="form-group">
            <button class="btn btn-success">Tambah Layanan</button>
        </div>
    </form>
@endsection
