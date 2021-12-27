<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Layanan;
use Illuminate\Pagination\Paginator;

class LayananControllerView extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Paginator::useBootstrap();
        $layanan = Layanan::paginate(env('PER_PAGE'));
        return view('layanan.layanan',compact('layanan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layanan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'harga' => 'required|numeric'
        ],[
            'nama.required' => 'kolom "Nama Layanan" tidak boleh kosong',
            'harga.required' => 'kolom "Harga" tidak boleh kosong',
            'harga.numeric'=>'kolom "Harga" harus diisi dengan angka'
        ]);
        $layanan = Layanan::create($request->all());
        return redirect()->back()->with('success', 'data layanan berhasil ditambah');
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
        $layanan = Layanan::findorfail($id);
        return view('layanan.edit',compact('layanan'));
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
        $this->validate($request, [
            'nama' => 'required',
            'harga' => 'required|numeric'
        ],[
            'nama.required' => 'kolom "Nama Layanan" tidak boleh kosong',
            'harga.required' => 'kolom "Harga" tidak boleh kosong',
            'harga.numeric'=>'kolom "Harga" harus diisi dengan angka'
        ]);
        $data_layanan = [
            'nama' => $request->nama,
            'harga' => $request->harga
        ];
        Layanan::whereId($id)->update($data_layanan);
        return redirect()->route('layanan.index')->with('success', "data berhasil diubah");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $layanan = Layanan::findorfail($id);
        $layanan->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
