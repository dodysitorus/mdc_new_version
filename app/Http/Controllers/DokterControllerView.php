<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class DokterControllerView extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Paginator::useBootstrap();
        $dokter = Dokter::paginate(env('PER_PAGE'));
        return view('dokter.dokter',compact('dokter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dokter.create');
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
            'spesialis' => 'required'
        ],[
            'nama.required' => 'kolom "Nama Dokter" tidak boleh kosong',
            'spesialis.required' => 'kolom "Spesialis" tidak boleh kosong'
        ]);
        $dokter = Dokter::create($request->all());
        return redirect()->back()->with('success', 'data dokter berhasil ditambah');
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
        $dokter = Dokter::findorfail($id);
        return view('dokter.edit',compact('dokter'));
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
            'spesialis' => 'required'
        ],[
            'nama.required' => 'kolom "Nama Dokter" tidak boleh kosong',
            'spesialis.required' => 'kolom "Spesialis" tidak boleh kosong'
        ]);

        $data_dokter = [
            'nama' => $request->nama,
            'spesialis' => $request->spesialis
        ];

        Dokter::whereId($id)->update($data_dokter);
        return redirect()->route('dokter.index')->with('success', "data berhasil diubah");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dokter = Dokter::findorfail($id);
        $dokter->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
