@extends('template.home')
@section('judul','Layanan')
@section('content')
    @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
            @php
                Session::forget('success')
            @endphp
        </div>
    @endif
    <a href="{{route('layanan.create')}}" class="btn btn-success">Tambah layanan</a>

    <br></br>
    <table class="table table-striped mb-0">
        <thead>
        <tr>
            <th>#</th>
            <th>Nama layanan</th>
            <th>Harga</th>
            <th>Action</th>
        </tr>
        </thead>
        @foreach($layanan as $result => $hasil)
            <tbody>
            <tr>
                <td>{{ $result + $layanan->firstitem() }}</td>
                <td>{{$hasil->nama}}</td>
                <td>{{$hasil->harga}}</td>
                <td>
                    <form action="{{route('layanan.destroy',$hasil->id)}}" method="POST">
                        @csrf
                        @method('delete')
                        <a href="{{route('layanan.edit',$hasil->id)}}" class="btn btn-warning btn-action mr-1" data-toggle="tooltip" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                        <button class="btn btn-danger" onclick="return confirm('Apakah Anda yakin menghapus data?')" data-toggle="tooltip" title="Delete" ><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            </tbody>
        @endforeach
    </table>
    <br></br>
    {{$layanan->links('pagination::bootstrap-4')}}
@endsection

