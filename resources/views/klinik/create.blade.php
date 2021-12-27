@extends('template/home')
@section('judul','Tambah Data Klinik')
@section('content')
    <form action="{{route('klinik.store')}}" method="POST">
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
            <label>Nama Klinik</label>
            <input type="text" class="form-control" name="nama">
            @if($errors->has('nama'))
                <span class="text-danger">{{ $errors->first('nama') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label>Alamat Klinik</label>
            <input type="text" class="form-control" name="alamat">
            @if($errors->has('alamat'))
                <span class="text-danger">{{ $errors->first('alamat') }}</span>
            @endif
        </div>
        <div class="form-group">
            <button class="btn btn-success">Tambah Klinik</button>
        </div>
    </form>
@endsection
