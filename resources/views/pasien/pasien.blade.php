@extends('template.home')
@section('judul','Pasien')
@section('content')
        @if(Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
                @php
                    Session::forget('success')
                @endphp
            </div>
        @endif
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4></h4>
                    <div class="card-header-action">
                        <a href="export-csv" class="btn btn-primary">Export Excel</a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                            <tr>
                                <th>Referal MDC</th>
                                <th>Nama</th>
                                <th>Tanggal Lahir</th>
                                <th>Usia</th>
                                <th>WA</th>
                                <th>Biaya</th>
                                <th>Layanan</th>
                                <th>Dokter</th>
                                <th>Cabang</th>
                                <th>Nama Admin</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            @foreach($pasien as $result => $hasil)
                                <tbody>
                                <tr>
                                    <td>{{$hasil->referal_id_mdc}}</td>
                                    <td>{{$hasil->nama}}</td>
                                    <td>{{$hasil->tanggal_lahir}}</td>
                                    <td>{{$hasil->usia}}</td>
                                    <td>{{$hasil->telephone}}</td>
                                    <td>{{$hasil->biaya}}</td>
                                    <td>{{$hasil->nama_layanan}}</td>
                                    <td>{{$hasil->nama_dokter}}</td>
                                    <td>{{$hasil->cabang}}</td>
                                    <td>{{$hasil->admin}}</td>
                                    <td>
                                        <form action="{{route('pasien.destroy',$hasil->id)}}" method="POST">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-danger" onclick="return confirm('Apakah Anda yakin menghapus data?')" data-toggle="tooltip" title="Delete" ><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                </tbody>
                            @endforeach
                        </table>
                        <br></br>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

