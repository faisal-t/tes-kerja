<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Jenis;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $data = Barang::with("jenis")->get();
        $jenis = Jenis::all();
        return view('admin.barang.index',compact(['data','jenis']));
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
        $data = $request->validate([
            'name' => 'required',
            'jenis_id' => 'required',
            'stok' => 'required',
        ]);

        Barang::create($data);

        return back()->with('status', 'Berhasil Tambah Barang');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(Barang $barang)
    {
        return response($barang);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit(Barang $barang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Barang $barang)
    {
        $data = $request->validate([
            'name' => 'required',
            'jenis_id' => 'required',
            'stok' => 'required',
        ]);

        $barang->update($data);
        return back()->with('status', 'Berhasil Edit Barang');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barang $barang)
    {
        $barang->delete();
        return back()->with('status', 'Berhasil Hapus Barang');
    }
}
