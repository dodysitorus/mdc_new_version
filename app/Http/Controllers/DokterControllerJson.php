<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokter;
use App\Http\Resources\DokterResource;
use Illuminate\Support\Facades\Validator;

class DokterControllerJson extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dokter = Dokter::all();
        $response = [
            'succes' => true,
            'data' => DokterResource::collection($dokter),
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
            'spesialis' => 'required'
        ];

        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()){
            $response =[
                'message' => $validator->errors()
            ];
            return response()->json($response,403);
        }

        $dokter = Dokter::create($input);
        $response = [
            'succes' => true,
            'data' => new DokterResource($dokter),
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
        $dokter = Dokter::find($id);

        if(is_null($dokter)){
            $response = [
                'succes' => false,
                'message' => "Data tidak ditemukan"
            ];
            return response()->json($response ,403);
        }
        $response = [
            'succes' => true,
            'data' => new DokterResource($dokter),
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
    public function update(Request $request, Dokter $dokter)
    {
        $input = $request->all();

        $rules =[
            'nama'=> 'required',
            'spesialis' => 'required'
        ];

        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()){
            $response =[
                'succes' => false,
                'message' => $validator->errors()
            ];
            return response()->json($response,403);
        }

        $dokter->nama = $input['nama'];
        $dokter->spesialis = $input['spesialis'];
        $dokter->save();

        $response = [
            'succes' => true,
            'data' => new DokterResource($dokter),
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
    public function destroy(Dokter $dokter)
    {
        $dokter->delete();
        $response = [
            'succes' => true,
            'message' => 'Data berhasil dihapus'
        ];
        return response()->json($response,200);
    }
}
