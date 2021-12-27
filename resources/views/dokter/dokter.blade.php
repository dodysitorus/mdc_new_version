@extends('template.home')
@section('judul','Dokter')
@section('content')
    @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
            @php
                Session::forget('success')
            @endphp
        </div>
    @endif
    <a href="{{route('dokter.create')}}" class="btn btn-success">Tambah Dokter</a>
    <br></br>
    <table class="table table-striped mb-0">
        <thead>
        <tr>
            <th>#</th>
            <th>Nama Dokter</th>
            <th>Spesialis</th>
            <th>Action</th>
        </tr>
        </thead>
        @foreach($dokter as $result => $hasil)
            <tbody>
            <tr>
                <td>{{ $result + $dokter->firstitem() }}</td>
                <td>{{$hasil->nama}}</td>
                <td>{{$hasil->spesialis}}</td>
                <td>
                    <form action="{{route('dokter.destroy',$hasil->id)}}" method="POST">
                        @csrf
                        @method('delete')
                        <a href="{{route('dokter.edit',$hasil->id)}}" class="btn btn-warning btn-action mr-1" data-toggle="tooltip" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                        <button class="btn btn-danger" onclick="return confirm('Apakah Anda yakin menghapus data?')" data-toggle="tooltip" title="Delete" ><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            </tbody>
        @endforeach
    </table>
    <br></br>
    {{$dokter->links('pagination::bootstrap-4')}}
@endsection

