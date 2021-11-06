<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Transaksi::with("barang")->get();
        return response([
            'message' => 'success',
            'data' => $data,
        ]);
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
        //stok tidak usah di validasi dikarenakan pengecekan di bakcend
        $data = $request->validate([
            'barang_id' => 'required',
            'terjual' => 'required',
        ]);

       

        $barang = Barang::where('id',$data['barang_id'])->first();
        $stok = $barang->stok - $data['terjual'];

        if ($stok >= 0) {
            $data['stok'] = $barang->stok;
            $barang->update(['stok' => $stok]);
            Transaksi::create($data);
        }else{
            return response([
                'message' => 'transaksi gagal dikarenakan stok tidak cukup',
            ]);
        }

        
        return response([
            'message' => 'transaksi berhasil dibuat',
            'data' => $data,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function show(Transaksi $transaksi)
    {
        return response($transaksi);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        //stok tidak usah di validasi dikarenakan pengecekan di bakcend
        $data = $request->validate([
            'barang_id' => 'required',
            'terjual' => 'required',
        ]);

        $barang = Barang::where('id',$data['barang_id'])->first();
        $stok = ($barang->stok + $transaksi->terjual) - $data['terjual'];

        if ($stok >= 0) {
            $data['stok'] = $stok;
            $barang->update(['stok' => $stok]);
            $transaksi->update($data);
            
        }else{
            return response([
                'message' => 'transaksi gagal dikarenakan stok tidak cukup',
            ]);
        }

        
        return response([
            'message' => 'transaksi berhasil dibuat',
            'data' => $data,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();
        return response([
            'message' => 'transaksi berhasil dihapus'
        ]);
    }
}
