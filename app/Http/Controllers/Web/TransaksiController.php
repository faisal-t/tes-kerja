<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Jenis;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Transaksi::query()
            ->select('transaksis.*')
            ->join('barangs', 'barang_id', 'barangs.id')
            ->when($request->has('tanggal_transaksi'), fn ($query) => $query->where('updated_at', 'like', '%' . $request->tanggal_transaksi . '%'))
            ->when($request->has('nama_barang'), fn ($query) => $query->where('barangs.name', 'like', '%' . $request->nama_barang . '%'))
            ->when($request->has('order_nama'), fn ($query) => $query->orderBy('barangs.name', $request->order_nama))
            ->when($request->has('order_tanggal'), fn ($query) => $query->orderBy('updated_at', $request->order_tanggal))
            ->with('barang')
            ->get();

        $barang = Barang::all();
        return view('admin.transaksi.index', compact(['data', 'barang']));
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



        $barang = Barang::where('id', $data['barang_id'])->first();
        $stok = $barang->stok - $data['terjual'];

        if ($stok >= 0) {
            $data['stok'] = $barang->stok;
            $barang->update(['stok' => $stok]);
            Transaksi::create($data);
            return back()->with('status', 'Berhasil Tambah Transaksi');
        } else {
            return back()->with('status', 'Gagal Stok Barang Tidak Cukup');
        }
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

        $barang = Barang::where('id', $data['barang_id'])->first();
        $stok = ($barang->stok + $transaksi->terjual) - $data['terjual'];

        if ($stok >= 0) {
            $data['stok'] = $stok;
            $barang->update(['stok' => $stok]);
            $transaksi->update($data);
        } else {
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
        try {
            $transaksi->delete();
            return back()->with('status', 'Berhasil Hapus Transaksi');
        } catch (\Exception $e) {
            return back()->with('status', 'Gagal hapus Jenis Barang Karena sudah memiliki relasi');
        }
    }

    public function transaksis(Request $request)
    {
        $data = Jenis::withCount('transaksis')->orderBy('transaksis_count')
            ->when(
                request()->has('from', 'to'),
                fn ($query) =>
                $query->whereBetween('updated_at', [request('from'), \Date::createFromFormat('Y-m-d', request('to'))])
            )->dd();

        return response($data);
    }
}
