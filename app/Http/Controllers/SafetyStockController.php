<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use Carbon\Carbon;

class SafetyStockController extends Controller
{
   public function index(){
    $ss = DB::select("SELECT barang.id, barang.nama, MAX(detail_barang_keluar.jumlah) as max_harian, AVG(detail_barang_keluar.jumlah) as rata FROM barang
    JOIN detail_barang_keluar ON detail_barang_keluar.id_barang=barang.id
    GROUP BY barang.id, barang.nama");

    $barang = Barang::sum('stok');
    $bm = BarangMasuk::whereBetween('created_at',[Carbon::now()->startOfMonth(), Carbon::now()->endOfmonth()])->sum('jumlah');
    $bk = BarangKeluar::whereBetween('created_at',[Carbon::now()->startOfMonth(), Carbon::now()->endOfmonth()])->sum('jumlah');
    $jumlah = Barang::count();
    return view('stock.index',compact('ss','barang','jumlah','bk','bm'));
   }
}
