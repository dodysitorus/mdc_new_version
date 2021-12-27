@extends('template.home')
@section('judul','Pasien Member Detail')
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
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <h4>Detail Penambahan Cicilan</h4>
                        <table class="table table-striped mb-0">
                            <thead>
                            <tr>
                                <th>Jumlah</th>
                                <th>Tanggal Penambahan Cicilan</th>
                            </tr>
                            </thead>
                            @foreach($penambahan as $result => $hasil)
                                <tbody>
                                <tr>
                                    <td>{{$hasil->nilai_cicilan}}</td>
                                    <td>{{$hasil->created_at}}</td>
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

    <div class="row">
        <div class="col-lg-12 col-md-12 col-12 col-sm-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <h4>Detail Pembayaran Menggunakan Cicilan</h4>
                        <table class="table table-striped mb-0">
                            <thead>
                            <tr>
                                <th>Biaya</th>
                                <th>Layanan</th>
                                <th>Dokter</th>
                                <th>Cabang</th>
                                <th>Nama Admin</th>
                                <th>Tanggal/Waktu Pembayaran</th>
                            </tr>
                            </thead>
                                 @foreach($pembayaran as $result => $hasil)
                                    <tbody>
                                        <tr>
                                            <td>{{$hasil->biaya}}</td>
                                            <td>{{$hasil->nama_layanan}}</td>
                                            <td>{{$hasil->nama_dokter}}</td>
                                            <td>{{$hasil->cabang}}</td>
                                            <td>{{$hasil->admin}}</td>
                                            <td>{{$hasil->created_at}}</td>
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

