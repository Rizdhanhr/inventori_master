<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Penyesuaian;
use App\Models\DetailPenyesuaian;
use App\Models\Barang;
use Alert;
use Str;
use DB;

class PenyesuaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penyesuaian = Penyesuaian::orderBy('created_at','desc')->get();
        return view('penyesuaian.index',compact('penyesuaian'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $barang = Barang::all();
        $penyesuaian = DetailPenyesuaian::where('status',0)->get();
        return view('penyesuaian.create',compact('barang','penyesuaian'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'id_barang' => 'required',
            'stok_aktual' => 'required|numeric|different:stok_tercatat'
        ],[
            'id_barang.required' => 'Barang Harus Dipilih !',
            'stok.required' => 'Masukkan Stok Aktual !',
            'stok_aktual.different' => 'Stok Aktual dan Stok Tercatat tidak boleh sama !'
        ]);

        try{
            $cek = DetailPenyesuaian::where(['id_barang' => $request->id_barang, 'status' => 0])->count();
            $barang = DetailPenyesuaian::where(['id_barang' => $request->id_barang, 'status' => 0])->first();
            if($cek > 0 ){
                DetailPenyesuaian::where(['id_barang' => $request->id_barang, 'status' => 0])->update([
                    'stok_tercatat' => $request->stok_tercatat,
                    'id_barang' => $request->id_barang,
                    'stok_aktual' => $request->stok_aktual
                ]);
                alert()->success('Sukses','Barang Berhasil Diupdate');
                return redirect()->back();
            }else{
                DetailPenyesuaian::create([
                    'id_barang' => $request->id_barang,
                    'stok_tercatat' => $request->stok_tercatat,
                    'stok_aktual' => $request->stok_aktual
                ]);
            }
            alert()->success('Sukses','Barang berhasil ditambahkan!');
            return redirect()->back();
        }catch(\Exception $e){

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $no_penyesuaian)
    {
        $detail = DetailPenyesuaian::where('no_penyesuaian',$no_penyesuaian)->get();
        $catatan = Penyesuaian::where('no_penyesuaian',$no_penyesuaian)->first();
        return view('penyesuaian.show',compact('detail','no_penyesuaian','catatan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $no_penyesuaian)
    {
        $detail = DetailPenyesuaian::where('no_penyesuaian',$no_penyesuaian)->get();
        $catatan = Penyesuaian::where('no_penyesuaian',$no_penyesuaian)->first();
        return view('penyesuaian.edit',compact('detail','no_penyesuaian','catatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $hapus = DetailPenyesuaian::where('id',$id)->first();
            $count = DetailPenyesuaian::where('no_penyesuaian',$hapus->no_penyesuaian)->count();
            $update = Penyesuaian::where('no_penyesuaian',$hapus->no_penyesuaian)->first();
            $barang = Barang::where('id',$hapus->id_barang)->first();
            DB::transaction(function () use($hapus,$count,$update,$barang,$id){
            if($count == 1){
                Barang::where('id',$hapus->id_barang)->update([
                    'stok' =>  $hapus->stok_tercatat
                ]);
                DetailPenyesuaian::where('id',$id)->delete();
                Penyesuaian::where('no_penyesuaian',$hapus->no_penyesuaian)->delete();
            }
                Barang::where('id',$hapus->id_barang)->update([
                    'stok' => $hapus->stok_tercatat
                ]);
                DetailPenyesuaian::where('id',$id)->delete();
            });
            alert()->success('Sukses','Penyesuaian Barang Berhasil Dibatalkan');
            return redirect('penyesuaian');
        }catch(Exception $e){

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $barang = DetailPenyesuaian::find($id);
            $barang->delete();
            alert()->success('Sukses','Barang dihapus dari keranjang !');
            return redirect()->back();
        }catch(Exception $e){

        }
    }

    public function proses(Request $request){
        $this->validate($request,[
            'catatan'  => 'required'
        ],[
            'catatan.required' => 'Masukkan Catatan!',
        ]);

        try{
            $validasi = DetailPenyesuaian::where('status',0)->count();
            if($validasi == 0){
                alert()->error('Gagal !','Cart Kosong !');
                return redirect()->back();
            }
            $random = strtoupper(str::random(10));
            $inv = 'PEN'.'-'.$random;

            DB::transaction(function () use ($request, $random, $inv) {
                DetailPenyesuaian::where('status',0)->update([
                    'no_penyesuaian' => $inv,
                    'status' => 1
                ]);
                $penyesuaian = DetailPenyesuaian::where('no_penyesuaian',$inv)->get();
                foreach($penyesuaian as $row){
                    Barang::where('id',$row->id_barang)->update([
                        'stok' => $row->stok_aktual
                    ]);
                }
                Penyesuaian::create([
                    'no_penyesuaian' => $inv,
                    'catatan' => $request->catatan,
                ]);
            });
            alert()->success('Sukses','Penyesuaian Berhasil');
            return redirect()->back();
        }catch(Exception $e){

        }
    }
}
