<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\Paginator;
use App\Models\Klinik;
use Illuminate\Http\Request;

class KlinikControllerView extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Paginator::useBootstrap();
        $klinik = Klinik::paginate(env('PER_PAGE'));
        return view('klinik.klinik',compact('klinik'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('klinik.create');
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
            'alamat' => 'required'
        ],[
            'nama.required' => 'kolom "Nama Klinik" tidak boleh kosong',
            'alamat.required' => 'kolom "Alamat Klinik" tidak boleh kosong'
        ]);
        $klinik = Klinik::create($request->all());
        return redirect()->back()->with('success', 'data klinik berhasil ditambah');
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
        $klinik = Klinik::findorfail($id);
        return view('klinik.edit',compact('klinik'));
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
            'alamat' => 'required'
        ],[
            'nama.required' => 'kolom "Nama Klinik" tidak boleh kosong',
            'alamat.required' => 'kolom "Alamat Klinik" tidak boleh kosong'
        ]);
        $data_klinik = [
          'nama' => $request->nama,
          'alamat' => $request->alamat
        ];

        Klinik::whereId($id)->update($data_klinik);
        return redirect()->route('klinik.index')->with('success', "data berhasil diubah");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $klinik = Klinik::findorfail($id);
        $klinik->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
