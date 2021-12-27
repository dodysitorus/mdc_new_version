<?php

namespace App\Http\Controllers;

use App\Http\Resources\LayananResource;
use App\Models\PasienMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\PasienMemberResource;

class PasienMemberControllerJSON extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pasien_member = DB::select
        ("Select p.id, p.status_pasien, p.nama, p.tanggal_lahir, p.usia,
        p.telephone, k.nama as cabang, p.admin, p.created_at
        FROM pasien_members p join klinik k on p.cabang = k.id");



        $response = [
            'succes' => true,
            'data' => $pasien_member,
            'message' => 'Data berhasil didapatkan'
        ];
        return response()->json($response,200);
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
        $input = $request->all();

        $rules =[
            'status_pasien'=>'required',
            'nama' => 'required',
            'tanggal_lahir'=>'required',
            'usia'=>'required|numeric',
            'telephone'=>'required|numeric',
            'cabang'=>'required',
            'admin'=>'required',
        ];

        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()){
            $response =[
                'message' => $validator->errors()
            ];
            return response()->json($response,403);
        }

        $pasien = PasienMember::create($input);
        $response = [
            'succes' => true,
            'data' => new LayananResource($pasien),
            'message' => 'Data berhasil ditambahkan'
        ];

        return response()->json($response,200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    public function memberPayment(Request $request){
        $total_penambahan="";
        $total_pengeluaran="";

        $id_member = $request->id_member;
        $pasien_member = DB::select
        ("Select p.id, p.status_pasien, p.nama, p.tanggal_lahir, p.usia,
        p.telephone, k.nama as cabang, p.admin, p.created_at
        FROM pasien_members p join klinik k on p.cabang = k.id where p.id = '$id_member'");

        $penambahan = DB::select("select * from cicilans where id_member = '$id_member' ORDER BY id DESC");

        $pembayaran = DB::select("select pm.id_pembayaran,
                                        p.nama_layanan, p.biaya,
                                        p.nama_dokter,p.admin, p.created_at, k.nama as cabang
                                        from pembayaran_member pm join pasien p on pm.id_pembayaran = p.id
                                        join klinik k on p.cabang = k.id where pm.id_member = '$id_member' ORDER BY pm.id DESC");

        $total_penambahan = DB::select("SELECT SUM(c.nilai_cicilan) as cicilan_total FROM cicilans c
            JOIN pasien_members p ON c.id_member = p.id where c.id_member = '$id_member' GROUP BY c.id_member");

        $total_pengeluaran = DB::select("SELECT  SUM(pa.biaya) as pengeluaran
            FROM pasien pa JOIN pembayaran_member pm ON pa.id = pm.id_pembayaran
            JOIN pasien_members pam ON pm.id_member = pam.id where pm.id_member='$id_member' GROUP BY pm.id_member");

        $data = [
            'data_member'=>$pasien_member,
            'data_penambahan' => $penambahan,
            'data_pembayaran' => $pembayaran,
        ];

        if($total_penambahan==null && $total_pengeluaran == null){
            $response = [
                'succes' => true,
                'data'=>$data,
                'total_penambahan_cicilan'=>0,
                'total_pengeluaran_cicilan'=>0,
                'message' => 'Data berhasil didapatkan',
            ];
            return response()->json($response,200);
        }
        else if($total_penambahan != null && $total_pengeluaran == null){
            $response = [
                'succes' => true,
                'data'=>$data,
                'total_penambahan_cicilan'=>$total_penambahan[0]->cicilan_total,
                'total_pengeluaran_cicilan'=>0,
                'message' => 'Data berhasil didapatkan',
            ];
            return response()->json($response,200);
        }
        else if($total_penambahan == null && $total_pengeluaran != null){
            $response = [
                'succes' => true,
                'data'=>$data,
                'total_penambahan_cicilan'=>0,
                'total_pengeluaran_cicilan'=>$total_pengeluaran[0]->pengeluaran,
                'message' => 'Data berhasil didapatkan',
            ];
            return response()->json($response,200);
        }
        else{
            $response = [
                'succes' => true,
                'data'=>$data,
                'total_penambahan_cicilan'=>$total_penambahan[0]->cicilan_total,
                'total_pengeluaran_cicilan'=>$total_pengeluaran[0]->pengeluaran,
                'message' => 'Data berhasil didapatkan',
            ];
            return response()->json($response,200);
        }

    }

    public function filter(Request $request){
        $filter = $request->name;


        $pasien_member = DB::select
        ("Select p.id, p.status_pasien, p.nama, p.tanggal_lahir, p.usia,
        p.telephone, k.nama as cabang, p.admin, p.created_at
        FROM pasien_members p join klinik k on p.cabang = k.id where p.nama like '%$filter%'");

        $response = [
            'succes' => true,
            'data' => $pasien_member,
            'message' => 'Data berhasil didapatkan'
        ];
        return response()->json($response,200);
    }
}
