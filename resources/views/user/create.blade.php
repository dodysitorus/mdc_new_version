@extends('template/home')
@section('judul','Tambah User')
@section('content')
    <form action="{{route('user.store')}}" method="POST">
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
            <label>Username</label>
            <input type="text" class="form-control" name="name">
            @if($errors->has('name'))
                <span class="text-danger">{{ $errors->first('name') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="text" class="form-control" name="email">
            @if($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label>Role</label>
            <select class="form-control" name="role">
                <option value="" holder>-- Pilih Role --</option>
                <option value ="Super Admin">Super Admin</option>
                <option value = "Admin">Admin</option>
            </select>
            @if($errors->has('role'))
                <span class="text-danger">{{ $errors->first('role') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label>Klinik</label>
            <select class="form-control" name="klinik_id">
                <option value = "" holder>-- Pilih Klinik --</option>
                @foreach ($klinik as $result)
                    <option value="{{$result->id}}">{{$result->nama}}</option>
                @endforeach
            </select>
            @if($errors->has('klinik_id'))
                <span class="text-danger">{{ $errors->first('klinik_id') }}</span>
            @endif
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" name="password">
            @if($errors->has('password'))
                <span class="text-danger">{{ $errors->first('password') }}</span>
            @endif
        </div>
        <div class="form-group">
            <button class="btn btn-success">Tambah User</button>
        </div>
    </form>
@endsection
