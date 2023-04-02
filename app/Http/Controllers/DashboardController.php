<?php

namespace App\Http\Controllers;
use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use App\Models\SuratJalan;
use App\Models\DetailBarangKeluar;
use DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang_keluar = DB::select("SELECT SUM(barang_keluar.jumlah) AS total, MONTHNAME(barang_keluar.created_at) AS bulan FROM barang_keluar
        WHERE YEAR(barang_keluar.created_at) = YEAR(CURRENT_DATE())
        GROUP BY MONTHNAME(barang_keluar.created_at)
        ORDER BY month(barang_keluar.created_at)");
        foreach($barang_keluar as $query){
            $bulan[] = $query->bulan;
            $total[] = $query->total;
        }

        $data = [
            'jumlah_bm' => BarangMasuk::whereBetween('created_at',[Carbon::now()->startOfWeek(), Carbon::now()->endOfweek()])->sum('jumlah'),
            'jumlah_bk' => BarangKeluar::whereBetween('created_at',[Carbon::now()->startOfWeek(), Carbon::now()->endOfweek()])->sum('jumlah'),
            'barang' => Barang::count(),
            'bm' =>  BarangMasuk::whereMonth('created_at',Carbon::now()->month)->sum('jumlah'),
            'bk' =>  BarangKeluar::whereMonth('created_at',Carbon::now()->month)->sum('jumlah'),
            'jumlah_surat' => SuratJalan::whereBetween('created_at',[Carbon::now()->startOfWeek(), Carbon::now()->endOfweek()])->count(),

        ];
        return view('dashboard.index',compact('total','bulan'))->with($data);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
