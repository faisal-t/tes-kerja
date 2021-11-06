<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use Error;
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
        try {
            $data = $request->validate([
                'name' => 'required',
            ]);

            Jenis::create($data);

            return response([
                'message' => 'jenis barang berhasil dibuat',
                'data' => $data,
            ]);
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return response([
                    'status' => 'error',
                    'message' => 'data duplikat',
                ]);
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
        return response([
            'message' => 'jenis barang berhasil diupdate',
            'data' => $data,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jenis  $jenis
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jenis $barang)
    {
        $barang->delete();
        return response([
            'message' => 'jenis barang berhasil dihapus',
        ]);
    }
}
