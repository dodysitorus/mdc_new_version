@extends('template.home')
@section('judul','Klinik')
@section('content')
    @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
            @php
                Session::forget('success')
            @endphp
        </div>
    @endif
    <a href="{{route('klinik.create')}}" class="btn btn-success">Tambah Klinik</a>

    <br></br>
    <table class="table table-striped mb-0">
        <thead>
        <tr>
            <th>#</th>
            <th>Nama Klinik</th>
            <th>Alamat Klinik</th>
            <th>Action</th>
        </tr>
        </thead>
        @foreach($klinik as $result => $hasil)
        <tbody>
        <tr>
            <td>{{ $result + $klinik->firstitem() }}</td>
            <td>{{$hasil->nama}}</td>
            <td>{{$hasil->alamat}}</td>
            <td>
                 <form action="{{route('klinik.destroy',$hasil->id)}}" method="POST">
                    @csrf
                    @method('delete')
                     <a href="{{route('klinik.edit',$hasil->id)}}" class="btn btn-warning btn-action mr-1" data-toggle="tooltip" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                     <button class="btn btn-danger" onclick="return confirm('Apakah Anda yakin menghapus data?')" data-toggle="tooltip" title="Delete" ><i class="fas fa-trash"></i></button>
                </form>
            </td>
        </tr>
        </tbody>
        @endforeach
    </table>
    <br></br>
    {{$klinik->links('pagination::bootstrap-4')}}
@endsection

