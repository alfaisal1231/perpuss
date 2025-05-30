<?php

namespace App\Http\Controllers;

use App\Models\Koleksi;
use Illuminate\Http\Request;

class KoleksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Koleksi::all();
        $codeData = Koleksi::createCode();
        return view('koleksi.index')->with([
            'data' => $data,
            'codeData' => $codeData,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            'kd_koleksi' => $request->input('kd_koleksi'),
            'judul' => $request->input('judul'),
            'jk' => $request->input('jk'),
            'pengarang' => $request->input('pengarang'),
            'penerbit' => $request->input('penerbit'),
            'tahun' => $request->input('tahun'),
            'status' => $request->input('status'),
        ];
        Koleksi::create($data);
        return back()->with('message_insert', 'Data Sudah ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = [
            'judul' => $request->input('judul'),
            'jk' => $request->input('jk'),
            'pengarang' => $request->input('pengarang'),
            'penerbit' => $request->input('penerbit'),
            'tahun' => $request->input('tahun'),
            'status' => $request->input('status'),
        ];

        $datas = Koleksi::findOrFail($id);
        $datas->update($data);
        return back()->with('message_update', 'Data Sudah diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Koleksi::findOrFail($id);
        $data->delete();
        return back()->with('message_delete', 'Data Berhasil dihapus');
    }
}
