<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Exports\ExportLapPenyesuaian;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\DetailPenyesuaian;

class LaporanPenyesuaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $awal = $request->awal;
        $akhir = $request->akhir;
        if($awal && $akhir){
        $laporan = DetailPenyesuaian::whereBetween('created_at',[$awal, $akhir])
                   ->orderBy('created_at','desc')
                   ->get();
        }else{
        $laporan = DetailPenyesuaian::orderBy('created_at','desc')->limit(5)->get();
        }

        return view('laporan_penyesuaian.index',compact('laporan','awal','akhir'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        //
    }

    public function export(Request $request){
        $awal = $request->awal;
        $akhir = $request->akhir;

        return Excel::download(new ExportLapPenyesuaian($awal,$akhir), 'lap-penyesuaian.xlsx');
    }
}
