<?php

namespace App\Http\Controllers;

use App\Models\Kebijakan;
use Illuminate\Http\Request;

class KebijakanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Kebijakan::all();
        return view('kebijakan.index')->with([
            'data' => $data,
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
            'max_wkt_pjm' => $request->input('max_wkt_pjm'),
            'max_jml_koleksi' => $request->input('max_jml_koleksi'),
            'denda' => $request->input('denda')
        ];
        Kebijakan::create($data);
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
            'max_wkt_pjm' => $request->input('max_wkt_pjm'),
            'max_jml_koleksi' => $request->input('max_jml_koleksi'),
            'denda' => $request->input('denda')
        ];

        $datas = Kebijakan::findOrFail($id);
        $datas->update($data);
        return back()->with('message_update', 'Data Sudah diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Kebijakan::findOrFail($id);
        $data->delete();
        return back()->with('message_delete', 'Data Berhasil dihapus');
    }
}
