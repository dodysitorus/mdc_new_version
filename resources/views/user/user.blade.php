@extends('template.home')
@section('judul','User')
@section('content')
    @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
            @php
                Session::forget('success')
            @endphp
        </div>
    @endif
        <a href="{{route('user.create')}}" class="btn btn-success">Tambah User</a>
    <br></br>
    <table class="table table-striped mb-0">
        <thead>
        <tr>
            <th>#</th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Klinik</th>
            <th>Action</th>
        </tr>
        </thead>
        @foreach($user as $result => $hasil)
            <tbody>
            <tr>
                <td>{{ $result + $user->firstitem() }}</td>
                <td>{{$hasil->name}}</td>
                <td>{{$hasil->email}}</td>
                <td>
                    @if($hasil->role == 'Super Admin')
                        <span class="badge badge-info">Super Admin</span>
                    @else
                        <span class="badge badge-warning">Admin</span>
                    @endif
                </td>
                <td>{{$hasil->klinik->nama}}</td>
                <td>
                    <form action="{{route('user.destroy',$hasil->id)}}" method="POST">
                        @csrf
                        @method('delete')
                        <a href="{{route('user.edit',$hasil->id)}}" class="btn btn-warning btn-action mr-1" data-toggle="tooltip" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                        <button class="btn btn-danger" onclick="return confirm('Apakah Anda yakin menghapus data?')" data-toggle="tooltip" title="Delete" ><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            </tbody>
        @endforeach
    </table>
    <br></br>
    {{$user->links('pagination::bootstrap-4')}}
@endsection

