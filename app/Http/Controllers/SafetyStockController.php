<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class SafetyStockController extends Controller
{
   public function index(){
    $ss = DB::select("SELECT barang.id, barang.nama, MAX(detail_barang_keluar.jumlah) as max_harian, AVG(detail_barang_keluar.jumlah) as rata FROM barang
    JOIN detail_barang_keluar ON detail_barang_keluar.id_barang=barang.id
    GROUP BY barang.id, barang.nama");
    return view('stock.index',compact('ss'));
   }
}
