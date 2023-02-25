<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Barang;
use App\Models\DetailBarangKeluar;
use App\Models\BarangKeluar;
use App\Models\Pelanggan;
use Carbon\Carbon;
use Str;
use Alert;
use DB;

class BarangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barang_keluar = BarangKeluar::latest()->get();
        return view('barang_keluar.index',compact('barang_keluar'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pelanggan = Pelanggan::all();
        $bm = DetailBarangKeluar::where('status',0)->get();
        $barang = Barang::all();
        $total = DetailBarangKeluar::where('status',0)->sum('subtotal');
        return view('barang_keluar.create',compact('barang','bm','total','pelanggan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request,[
            'id_barang' => 'required',
            'jumlah' => 'required|gt:0'
        ],[
            'id_barang.required' => 'Barang Harus Dipilih !',
            'jumlah.required' => 'Masukkan Jumlah Barang !',
            'jumlah.gt' => 'Jumlah Tidak Boleh 0 !'
        ]);

        $barang = Barang::where('id',$request->id_barang)->first();
        if($request->jumlah > $barang->stok){
            alert()->error('Gagal','Stok Tidak Cukup !');
            return redirect()->back();
        }
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
}
