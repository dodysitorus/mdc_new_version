<?php

namespace App\Http\Controllers;

use App\Http\Resources\DokterResource;
use Illuminate\Http\Request;
use App\Models\Klinik;
use App\Http\Resources\KlinikResource;
use Illuminate\Support\Facades\Validator;

class KlinikControllerJson extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $klinik = Klinik::all();
        $response = [
            'succes' => true,
            'data' => KlinikResource::collection($klinik),
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
            'nama'=> 'required',
            'alamat' => 'required'
        ];
//        $message =[
//            'id_referal_mdc.required' => 'ID Wajib diisi',
//            'nama.required'=> 'Nama wajib diisi'
//        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()){
            $response =[
                'message' => $validator->errors()
            ];
            return response()->json($response,403);
        }

        $klinik = Klinik::create($input);
        $response = [
            'succes' => true,
            'data' => new DokterResource($klinik),
            'message' => 'Data berhasil didapatkan'
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
        $klinik = Klinik::find($id);

        if(is_null($klinik)){
            $response = [
                'succes' => false,
                'message' => "Data tidak ditemukan"
            ];
            return response()->json($response ,403);
        }
        $response = [
            'succes' => true,
            'data' => new KlinikResource($klinik),
            'message' => 'Data berhasil didapatkan'
        ];
        return response()->json($response,200);
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
    public function update(Request $request, Klinik $klinik)
    {
        $input = $request->all();

        $rules =[
            'nama'=> 'required',
            'alamat' => 'required'
        ];
//        $message =[
//            'id_referal_mdc.required' => 'ID Wajib diisi',
//            'nama.required'=> 'Nama wajib diisi'
//        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()){
            $response =[
                'succes' => false,
                'message' => $validator->errors()
            ];
            return response()->json($response,403);
        }

        $klinik->nama = $input['nama'];
        $klinik->alamat = $input['alamat'];
        $klinik->save();

        $response = [
            'succes' => true,
            'data' => new DokterResource($klinik),
            'message' => 'Data berhasil diubah'
        ];
        return response()->json($response,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Klinik $klinik)
    {
        $klinik->delete();
        $response = [
            'succes' => true,
            'message' => 'Data berhasil dihapus'
        ];
        return response()->json($response,200);
    }
}
