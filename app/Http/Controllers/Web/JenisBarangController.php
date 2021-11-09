<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Jenis;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class JenisBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Jenis::query()->get();

        return view('admin.jenis.index', compact(['data']));
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
        try {
            $data = $request->validate([
                'name' => 'required',
            ]);

            Jenis::create($data);

            return back()->with('status', 'Berhasil Tambah Jenis Barang');
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return back()->with('status', 'gagal data duplikat');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jenis  $jenis
     * @return \Illuminate\Http\Response
     */
    public function show(Jenis $jeni)
    {
        return response($jeni);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jenis  $jenis
     * @return \Illuminate\Http\Response
     */
    public function edit(Jenis $jeni)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jenis  $jenis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jenis $jeni)
    {
        $data = $request->validate([
            'name' => 'required',
        ]);

        $jeni->update($data);
        return back()->with('status', 'Berhasil Update Jenis Barang');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jenis  $jenis
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jenis $jeni)
    {
        try {
            $jeni->delete();
            return back()->with('status', 'Berhasil Hapus Jenis Barang');
        } catch (\Exception $e) {
            return back()->with('status', 'Gagal hapus Jenis Barang Karena sudah memiliki relasi');
        }
    }
}
