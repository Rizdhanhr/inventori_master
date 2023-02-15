<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Brand;
use App\Models\Satuan;
use Str;
use DB;
use Alert;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang = Barang::orderBy('created_at','desc')->get();
        return view('barang.index',compact('barang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = Kategori::all();
        $brand = Brand::all();
        $satuan = Satuan::all();
        return view('barang.create',compact('kategori','brand','satuan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'nama' => 'required|max:255',
            'kategori' => 'required',
            'brand' => 'required',
            'satuan' => 'required',
            'stok' => 'required',
            'stok_minim' => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'ket' => 'max:255',
            'lokasi' => 'max:255',
            'gambar' => 'mimes:jpg,jpeg,png'
        ]);
        try{
            DB::transaction(function () use ($request){
            if(!empty($request->input('kode'))){
                if($file = $request->file('gambar')){
                    $nama_file = time()."_".$file->getClientOriginalName();
                    $tujuan_upload = 'gambar_barang';
                    $file->move($tujuan_upload,$nama_file);
                    $barang = New Barang;
                    $barang->kode = $request->kode;
                    $barang->nama = $request->nama;
                    $barang->id_kategori = $request->kategori;
                    $barang->id_brand = $request->brand;
                    $barang->id_satuan = $request->satuan;
                    $barang->stok = $request->stok;
                    $barang->stok_minimal = $request->stok_minim;
                    $barang->harga_beli = $request->harga_beli;
                    $barang->harga_jual = $request->harga_jual;
                    $barang->keterangan = $request->ket;
                    $barang->lokasi = $request->lokasi;
                    $barang->gambar = $tujuan_upload.'/'.$nama_file;
                    $barang->save();
                }else{
                    $barang = New Barang;
                    $barang->nama = $request->nama;
                    $barang->kode = $request->kode;
                    $barang->id_kategori = $request->kategori;
                    $barang->id_brand = $request->brand;
                    $barang->id_satuan = $request->satuan;
                    $barang->stok = $request->stok;
                    $barang->stok_minimal = $request->stok_minim;
                    $barang->harga_beli = $request->harga_beli;
                    $barang->harga_jual = $request->harga_jual;
                    $barang->keterangan = $request->ket;
                    $barang->lokasi = $request->lokasi;
                    $barang->save();
                }
            }else{
                if($file = $request->file('gambar')){
                    $nama_file = time()."_".$file->getClientOriginalName();
                    $tujuan_upload = 'gambar_barang';
                    $file->move($tujuan_upload,$nama_file);
                    $barang = New Barang;
                    $barang->kode = Str::random(15);
                    $barang->nama = $request->nama;
                    $barang->id_kategori = $request->kategori;
                    $barang->id_brand = $request->brand;
                    $barang->id_satuan = $request->satuan;
                    $barang->stok = $request->stok;
                    $barang->stok_minimal = $request->stok_minim;
                    $barang->harga_beli = $request->harga_beli;
                    $barang->harga_jual = $request->harga_jual;
                    $barang->keterangan = $request->ket;
                    $barang->lokasi = $request->lokasi;
                    $barang->gambar = $tujuan_upload.'/'.$nama_file;
                    $barang->save();
                }else{
                    $barang = New Barang;
                    $barang->nama = $request->nama;
                    $barang->kode = Str::random(15);
                    $barang->id_kategori = $request->kategori;
                    $barang->id_brand = $request->brand;
                    $barang->id_satuan = $request->satuan;
                    $barang->stok = $request->stok;
                    $barang->stok_minimal = $request->stok_minim;
                    $barang->harga_beli = $request->harga_beli;
                    $barang->harga_jual = $request->harga_jual;
                    $barang->keterangan = $request->ket;
                    $barang->lokasi = $request->lokasi;
                    $barang->save();
                }

            }
            });

            alert()->success('Sukses','Data Tersimpan');
            return redirect('barang');
        }catch(Exception $e){

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $barang = Barang::find($id);
        return view('barang.show',compact('barang'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $barang = Barang::find($id);
        $kategori = Kategori::all();
        $brand = Brand::all();
        $satuan = Satuan::all();
        return view('barang.edit',compact('barang','kategori','brand','satuan'));
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
        $this->validate($request,[
            'kode' => 'required',
            'nama' => 'required|max:255',
            'kategori' => 'required',
            'brand' => 'required',
            'satuan' => 'required',
            'stok' => 'required',
            'stok_minim' => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'ket' => 'max:255',
            'lokasi' => 'max:255',
            'gambar' => 'mimes:jpg,jpeg,png'
        ]);

        try{
            DB::transaction(function () use($request, $id){
                $barang = Barang::findOrFail($id);
                if($file = $request->file('gambar')){
                    $nama_file = time()."_".$file->getClientOriginalName();
                    $tujuan_upload = 'gambar_barang';
                    $file->move($tujuan_upload,$nama_file);
                    $barang->kode = $request->kode;
                    $barang->nama = $request->nama;
                    $barang->id_kategori = $request->kategori;
                    $barang->id_brand = $request->brand;
                    $barang->id_satuan = $request->satuan;
                    $barang->stok = $request->stok;
                    $barang->stok_minimal = $request->stok_minim;
                    $barang->harga_beli = $request->harga_beli;
                    $barang->harga_jual = $request->harga_jual;
                    $barang->keterangan = $request->ket;
                    $barang->lokasi = $request->lokasi;
                    $barang->gambar = $tujuan_upload.'/'.$nama_file;
                    $barang->save();
                }else{
                    $barang->kode = $request->kode;
                    $barang->nama = $request->nama;
                    $barang->kode = $request->kode;
                    $barang->id_kategori = $request->kategori;
                    $barang->id_brand = $request->brand;
                    $barang->id_satuan = $request->satuan;
                    $barang->stok = $request->stok;
                    $barang->stok_minimal = $request->stok_minim;
                    $barang->harga_beli = $request->harga_beli;
                    $barang->harga_jual = $request->harga_jual;
                    $barang->keterangan = $request->ket;
                    $barang->lokasi = $request->lokasi;
                    $barang->save();
                }
            });
            alert()->success('Sukses','Data Berhasil Diupdate');
            return redirect('barang');
        }catch(Exception $e){

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            DB::transaction(function () use($id) {
                $barang = Barang::find($id);
                $barang->delete();
            });
            alert()->success('Sukses','Data Terhapus');
            return redirect()->back();
        }catch(Exception $e){

        }

    }
}
