<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PasienMember;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;


class PasienMemberControllerView extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Paginator::useBootstrap();
        $pasien_member = DB::select
        ("Select p.id, p.status_pasien, p.nama, p.tanggal_lahir, p.usia,
        p.telephone, k.nama as cabang, p.admin, p.created_at
        FROM pasien_members p join klinik k on p.cabang = k.id");
        return view('PasienMember.pasien_member',compact('pasien_member'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $penambahan = DB::select("select * from cicilans where id_member = '$id'");
        $pembayaran = DB::select("select pm.id_pembayaran,
                                        p.nama_layanan, p.biaya,
                                        p.nama_dokter,p.admin, p.created_at, k.nama as cabang
                                        from pembayaran_member pm join pasien p on pm.id_pembayaran = p.id
                                        join klinik k on p.cabang = k.id where pm.id_member = '$id'");

        return view('PasienMember.detail',['penambahan'=>$penambahan, 'pembayaran'=>$pembayaran]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
