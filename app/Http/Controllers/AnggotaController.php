<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\User;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Anggota::all();
        $codeData = Anggota::createCode();
        return view('anggota.index')->with([
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
            'kd_anggota' => $request->input('kd_anggota'),
            'nm_anggota' => $request->input('nm_anggota'),
            'jk' => $request->input('jk'),
            'alamat' => $request->input('alamat'),
            'status' => $request->input('status'),
            'jml_pinjam' => 0,
        ];
        Anggota::create($data);

        $data = [
            'email' => $request->input('kd_anggota') . '@gmail.com',
            'password' => bcrypt('12345678'),
            'name' => $request->input('nm_anggota'),
            'role' => 'U',
            'status' => 'AKTIF',
        ];
        User::create($data);
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
            'nm_anggota' => $request->input('nm_anggota'),
            'jk' => $request->input('jk'),
            'alamat' => $request->input('alamat'),
            'status' => $request->input('status'),
        ];

        $datas = Anggota::findOrFail($id);
        $datas->update($data);
        return back()->with('message_update', 'Data Sudah diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Anggota::findOrFail($id);
        $data->delete();
        return back()->with('message_delete', 'Data Berhasil dihapus');
    }
}
