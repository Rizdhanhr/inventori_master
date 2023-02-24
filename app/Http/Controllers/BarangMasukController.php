<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Barang;
use App\Models\DetailBarangMasuk;
use App\Models\BarangMasuk;
use App\Models\Supplier;
use Carbon\Carbon;
use Str;
use Alert;
use DB;

class BarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barang_masuk = BarangMasuk::latest()->get();
        return view('barang_masuk.index',compact('barang_masuk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $supplier = Supplier::all();
        $bm = DetailBarangMasuk::where('status',0)->get();
        $barang = Barang::all();
        $total = DetailBarangMasuk::where('status',0)->sum('subtotal');
        return view('barang_masuk.create',compact('barang','bm','total','supplier'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'id_barang' => 'required',
            'jumlah' => 'required|gt:0'
        ],[
            'id_barang.required' => 'Barang Harus Dipilih !',
            'jumlah.required' => 'Masukkan Jumlah Barang !',
            'jumlah.gt' => 'Jumlah Tidak Boleh 0 !'
        ]);

        try{
            $cek = DetailBarangMasuk::where(['id_barang' => $request->id_barang, 'status' => 0])->count();
            $barang = DetailBarangMasuk::where(['id_barang' => $request->id_barang, 'status' => 0])->first();
            if($cek > 0 ){
                DetailBarangMasuk::where(['id_barang' => $request->id_barang, 'status' => 0])->update([
                    'id_barang' => $request->id_barang,
                    'jumlah' => $barang->jumlah + $request->jumlah,
                    'harga' => $request->harga,
                    'subtotal' => $barang->subtotal + ($request->jumlah * $request->harga)
                ]);
                alert()->success('Sukses','Barang Berhasil Diupdate');
                return redirect()->back();
            }else{
                DetailBarangMasuk::create([
                    'id_barang' => $request->id_barang,
                    'jumlah' => $request->jumlah,
                    'harga' => $request->harga,
                    'subtotal' => $request->jumlah * $request->harga
                ]);
            }
            alert()->success('Sukses','Barang berhasil ditambahkan!');
            return redirect()->back();

        }catch(Exception $e){

        }


    }

    /**
     * Display the specified resource.
     */
    public function show(string $no_trx)
    {
        $detail = DetailBarangMasuk::where(['no_trx' => $no_trx,'status' => 1])->get();

        return view('barang_masuk.show',compact('detail','no_trx'));
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $barang = DetailBarangMasuk::find($id);
            $barang->delete();
            alert()->success('Sukses','Barang dihapus dari keranjang !');
            return redirect()->back();
        }catch(Exception $e){

        }
    }

    public function getbarang(string $kode){
        $data = Barang::where('kode',$kode)->get();
        if($data->isEmpty()){
            return response()->json([
                'msg' => 'gagal'
            ]);
        }
        return response()->json($data[0]);


    }

    public function proses(Request $request){
        $this->validate($request,[
            'tgl_masuk'  => 'required',
            'supplier' => 'required'
        ],[
            'tgl_masuk.required' => 'Masukkan Tgl Masuk !',
            'supplier.required' => 'Masukkan Supplier !'
        ]);

        try{
            $validasi = DetailBarangMasuk::where('status',0)->count();
            if($validasi == 0){
                alert()->error('Gagal !','Cart Kosong !');
                return redirect()->back();
            }
            DB::transaction(function () use ($request) {
                $random = strtoupper(str::random(10));
                $inv = 'INV-BM'.'-'.$random;
                $total = DetailBarangMasuk::where('status', 0)->sum('subtotal');
                $jumlah = DetailBarangMasuk::where('status', 0)->sum('jumlah');
                DetailBarangMasuk::where('status',0)->update([
                    'no_trx' => $inv,
                    'status' => 1
                ]);
                $penyesuaian = DetailBarangMasuk::where('no_trx',$inv)->get();
                foreach($penyesuaian as $row){
                    Barang::where('id',$row->id_barang)->update([
                        'stok' => $row->barang->stok + $row->jumlah
                    ]);
                }
                BarangMasuk::create([
                    'no_trx' => $inv,
                    'id_supplier' => $request->supplier,
                    'total_harga' => $total,
                    'jumlah' => $jumlah,
                    'tgl_masuk' => $request->tgl_masuk
                ]);
            });
            alert()->success('Sukses','Transaksi Barang Masuk Berhasil');
            return redirect()->back();
        }catch(Exception $e){

        }
    }
}
