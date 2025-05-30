<?php

namespace App\Http\Controllers;

use App\Models\TrsPinjam;
use Illuminate\Http\Request;

class ReportPinjamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = collect();

        if ($request->has(['dari', 'sampai']) && $request->filled(['dari', 'sampai'])) {
            $request->validate([
                'dari' => 'required|date',
                'sampai' => 'required|date|after_or_equal:dari',
            ]);

            $data = TrsPinjam::whereBetween('tg_pinjam', [$request->dari, $request->sampai])->get();
        }

        return view('report.pinjam')->with([
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
