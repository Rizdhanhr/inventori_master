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

        $cekqty = Barang::where('id',$request->id_barang)->first();
        if($request->jumlah > $cekqty->stok){
            alert()->error('Gagal','Stok Tidak Cukup !');
            return redirect()->back();
        }

        try{
            $cek = DetailBarangKeluar::where(['id_barang' => $request->id_barang, 'status' => 0])->count();
            $barang = DetailBarangKeluar::where(['id_barang' => $request->id_barang, 'status' => 0])->first();
            if($cek > 0 ){
                DetailBarangKeluar::where(['id_barang' => $request->id_barang, 'status' => 0])->update([
                    'id_barang' => $request->id_barang,
                    'jumlah' => $barang->jumlah + $request->jumlah,
                    'harga' => $request->harga,
                    'subtotal' => $barang->subtotal + ($request->jumlah * $request->harga)
                ]);
                alert()->success('Sukses','Barang Berhasil Diupdate');
                return redirect()->back();
            }else{
                DetailBarangKeluar::create([
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
        $detail = DetailBarangKeluar::where('no_trx',$no_trx)->get();
        return view('barang_keluar.show',compact('detail','no_trx'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $no_trx)
    {
        $detail = DetailBarangKeluar::where('no_trx',$no_trx)->get();
        return view('barang_keluar.edit',compact('detail','no_trx'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $hapus = DetailBarangKeluar::where('id',$id)->first();
            $count = DetailBarangKeluar::where('no_trx',$hapus->no_trx)->count();
            $update = BarangKeluar::where('no_trx',$hapus->no_trx)->first();
            $barang = Barang::where('id',$hapus->id_barang)->first();
            DB::transaction(function () use($hapus,$count,$update,$barang,$id){
            if($count == 1){
                Barang::where('id',$hapus->id_barang)->update([
                    'stok' => $barang->stok + $hapus->jumlah
                ]);
                DetailBarangKeluar::where('id',$id)->delete();
                BarangKeluar::where('no_trx',$hapus->no_trx)->delete();
            }
                Barang::where('id',$hapus->id_barang)->update([
                    'stok' => $barang->stok + $hapus->jumlah
                ]);
                DetailBarangKeluar::where('id',$id)->delete();
                $jumlah = DetailBarangKeluar::where('no_trx',$hapus->no_trx)->sum('jumlah');
                $total = DetailBarangKeluar::where('no_trx',$hapus->no_trx)->sum('subtotal');
                BarangKeluar::where('no_trx',$hapus->no_trx)->update([
                    'jumlah' => $jumlah,
                    'total_harga' => $total
                ]);
            });
            alert()->success('Sukses','Transaksi Berhasil Dibatalkan');
            return redirect('transaksi-keluar');
        }catch(Exception $e){

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $barang = DetailBarangKeluar::find($id);
            $barang->delete();
            alert()->success('Sukses','Barang dihapus dari keranjang !');
            return redirect()->back();
        }catch(Exception $e){

        }
    }

    public function proses(Request $request){
        $this->validate($request,[
            'tgl_masuk'  => 'required',
            'keterangan' => 'required'
        ],[
            'tgl_masuk.required' => 'Masukkan Tgl Masuk !',
            'keterangan.required' => 'Masukkan Keterangan !'
        ]);

        try{
            $validasi = DetailBarangKeluar::where('status',0)->count();
            if($validasi == 0){
                alert()->error('Gagal !','Cart Kosong !');
                return redirect()->back();
            }
            DB::transaction(function () use ($request) {
                $random = strtoupper(str::random(10));
                $inv = 'INV-BK'.'-'.$random;
                $total = DetailBarangKeluar::where('status', 0)->sum('subtotal');
                $jumlah = DetailBarangKeluar::where('status', 0)->sum('jumlah');
                DetailBarangKeluar::where('status',0)->update([
                    'no_trx' => $inv,
                    'status' => 1
                ]);
                $penyesuaian = DetailBarangKeluar::where('no_trx',$inv)->get();
                foreach($penyesuaian as $row){
                    Barang::where('id',$row->id_barang)->update([
                        'stok' => $row->barang->stok - $row->jumlah
                    ]);
                }
                BarangKeluar::create([
                    'no_trx' => $inv,
                    'keterangan' => $request->keterangan,
                    'total_harga' => $total,
                    'jumlah' => $jumlah,
                    'tgl_keluar' => $request->tgl_masuk
                ]);
            });
            alert()->success('Sukses','Transaksi Barang Keluar Berhasil');
            return redirect()->back();
        }catch(Exception $e){

        }
    }
}
