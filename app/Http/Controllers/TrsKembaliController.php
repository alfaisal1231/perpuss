<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Kebijakan;
use App\Models\Koleksi;
use App\Models\Trskembali;
use App\Models\TrsPinjam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrsKembaliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Trskembali::all();
        $anggota = Anggota::all();
        $koleksi = Koleksi::all();

        $kebijakan = Kebijakan::first();
        $max_wkt_pjm = $kebijakan->max_wkt_pjm;
        return view('transaksi.kembali.index')->with([
            'data' => $data,
            'anggota' => $anggota,
            'koleksi' => $koleksi,
            'max_wkt_pjm' => $max_wkt_pjm,
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
        $no_transaksi_kembali = date('YmdHis');
    
    // Ambil data tanggal
    $tgl_kembali = $request->input('tgl_kembali');
    $tgl_bts_kembali = $request->input('tgl_bts_kembali');

    // Hitung denda otomatis
    $terlambat = \Carbon\Carbon::parse($tgl_bts_kembali)->diffInDays($tgl_kembali, false);
    $kebijakan = Kebijakan::first();
    $denda = $terlambat > 0 ? $terlambat * $kebijakan->denda : 0;

    $data = [
        'no_transaksi_kembali' => $no_transaksi_kembali,
        'kd_anggota' => $request->input('kd_anggota'),
        'tg_pinjam' => $request->input('tgl_pinjam'),
        'tg_bts_kembali' => $tgl_bts_kembali,
        'tg_kembali' => $tgl_kembali,
        'kd_koleksi' => $request->input('kd_koleksi'),
        'denda' => $denda,
        'ket' => $request->input('ket'),
        'id_pengguna' => Auth::user()->id,
    ];

    TrsKembali::create($data);

    // Ubah status koleksi jadi Tersedia (opsional jika tidak otomatis di tempat lain)
    $koleksi = Koleksi::where('kd_koleksi', $request->input('kd_koleksi'))->first();
    if($koleksi){
        $koleksi->status = 'TERSEDIA';
        $koleksi->save();
    }

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
        $tgl_kembali = $request->input('tgl_kembali');
    $tgl_bts_kembali = $request->input('tgl_bts_kembali');

    // Hitung denda otomatis
    $terlambat = \Carbon\Carbon::parse($tgl_bts_kembali)->diffInDays($tgl_kembali, false);
    $kebijakan = Kebijakan::first();
    $denda = $terlambat > 0 ? $terlambat * $kebijakan->denda : 0;

    $data = [
        'kd_anggota' => $request->input('kd_anggota'),
        'tg_pinjam' => $request->input('tgl_pinjam'),
        'tg_bts_kembali' => $tgl_bts_kembali,
        'tg_kembali' => $tgl_kembali,
        'kd_koleksi' => $request->input('kd_koleksi'),
        'denda' => $denda,
        'ket' => $request->input('ket'),
    ];

    $datas = TrsKembali::findOrFail($id);
    $datas->update($data);

    return back()->with('message_update', 'Data Sudah diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = TrsKembali::findOrFail($id);
        $kdKoleksi = $data->kd_koleksi;

        $koleksi = Koleksi::where('kd_koleksi', $kdKoleksi)->first();
        if($koleksi){
            $koleksi->status = 'TERSEDIA';
            $koleksi->save();
        }

        $data->delete();
        return back()->with('message_delete', 'Data Berhasil dihapus');
    }
}
