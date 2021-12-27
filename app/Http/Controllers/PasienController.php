<?php

namespace App\Http\Controllers;

use App\Http\Resources\LayananResource;
use App\Models\Layanan;
use App\Models\Pasien;
use Illuminate\Http\Request;
use App\Http\Resources\PasienResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PasienController extends Controller
{
    public function index()
    {
        $pasien = DB::select
        ("Select p.id, p.referal_id_mdc, p.status_pasien, p.nama, p.tanggal_lahir, p.usia,
        p.telephone, p.nama_layanan, p.biaya, p.nama_dokter, k.nama as cabang, p.admin, p.created_at
        FROM pasien p join klinik k on p.cabang = k.id");


        $array = $pasien;
        $response = [
            'succes' => true,
            'data' =>$array,
            'message' => 'Data berhasil didapatkan'
        ];
        return response()->json($response,200);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $rules =[
            'referal_id_mdc'=> 'required',
            'status_pasien'=>'required',
            'nama' => 'required',
            'tanggal_lahir'=>'required',
            'usia'=>'required|numeric',
            'telephone'=>'required|numeric',
            'nama_layanan'=>'required',
            'biaya'=>'required',
            'nama_dokter'=>'required',
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
            $pasien = Pasien::create($input);
        $response = [
            'succes' => true,
            'data' => new LayananResource($pasien),
            'message' => 'Data berhasil didapatkan'
        ];

        return response()->json($response,200);
    }

    public function filter(Request $request){
        $filter = $request->name;
        $pasien = DB::select
        ("Select p.id, p.referal_id_mdc, p.status_pasien, p.nama, p.tanggal_lahir, p.usia,
        p.telephone, p.nama_layanan, p.biaya, p.nama_dokter, k.nama as cabang, p.admin, p.created_at
        FROM pasien p join klinik k on p.cabang = k.id where p.nama LIKE '%$filter%'");


        $array = $pasien;
        $response = [
            'succes' => true,
            'data' =>$array,
            'message' => 'Data berhasil didapatkan'
        ];
        return response()->json($response,200);
    }
}
