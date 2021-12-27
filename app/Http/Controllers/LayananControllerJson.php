<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\LayananResource;
use App\Models\Layanan;

class LayananControllerJson extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $layanan = Layanan::all();
        $response = [
            'succes' => true,
            'data' => LayananResource::collection($layanan),
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
            'harga' => 'required|numeric'
        ];

        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()){
            $response =[
                'message' => $validator->errors()
            ];
            return response()->json($response,403);
        }

        $layanan = Layanan::create($input);
        $response = [
            'succes' => true,
            'data' => new LayananResource($layanan),
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
        $layanan = Layanan::find($id);

        if(is_null($layanan)){
            $response = [
                'succes' => false,
                'message' => "Data tidak ditemukan"
            ];
            return response()->json($response ,403);
        }
        $response = [
            'succes' => true,
            'data' => new LayananResource($layanan),
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
    public function update(Request $request, Layanan $layanan)
    {
        $input = $request->all();

        $rules =[
            'nama'=> 'required',
            'harga' => 'required|numeric'
        ];

        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()){
            $response =[
                'succes' => false,
                'message' => $validator->errors()
            ];
            return response()->json($response,403);
        }

        $layanan->nama = $input['nama'];
        $layanan->harga = $input['harga'];
        $layanan->save();

        $response = [
            'succes' => true,
            'data' => new LayananResource($layanan),
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
    public function destroy(Layanan $layanan)
    {
        $layanan->delete();
        $response = [
            'succes' => true,
            'message' => 'Data berhasil dihapus'
        ];
        return response()->json($response,200);
    }
}
