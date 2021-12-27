@extends('template.home')
@section('judul','Pasien Member')
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
                        <table class="table table-striped mb-0">
                            <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Tanggal Lahir</th>
                                <th>Usia</th>
                                <th>WA</th>
                                <th>Cabang</th>
                                <th>Nama Admin</th>
                                <th colspan="2" style="text-align: center">Action</th>
                            </tr>
                            </thead>
                            @foreach($pasien_member as $result => $hasil)
                                <tbody>
                                <tr>
                                    <td>{{$hasil->nama}}</td>
                                    <td>{{$hasil->tanggal_lahir}}</td>
                                    <td>{{$hasil->usia}}</td>
                                    <td>{{$hasil->telephone}}</td>
                                    <td>{{$hasil->cabang}}</td>
                                    <td>{{$hasil->admin}}</td>
                                    <td>
                                        <form action="{{route('pasien_member.show',$hasil->id)}}" method="GET">
                                            @method('get')
                                            @csrf
                                            <button class="btn btn-success" data-toggle="tooltip" title="Detail" ><i class="fa fa-address-card"></i></button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{route('pasien_member.destroy',$hasil->id)}}" method="POST">
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

