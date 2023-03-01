<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Alert;
use DB;
use Str;
use App\Models\DetailBarangKeluar;
use App\Models\BarangKeluar;
use App\Models\Pelanggan;
use App\Models\SuratJalan;

class SuratJalanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $surat = SuratJalan::orderBy('created_at','desc')->get();
        return view('surat_jalan.index',compact('surat'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($no_trx)
    {
        $pelanggan = Pelanggan::all();
        $detail = DetailBarangKeluar::where('no_trx',$no_trx)->get();
        return view('surat_jalan.create',compact('detail','pelanggan','no_trx'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'id_pelanggan' => 'required',
            'nama_driver' => 'required|max:100',
            'no_driver' => 'required|numeric',
            'nopol' => 'required|max:30',
            'keterangan' => 'required|max:100'
        ],
        [
            'id_pelanggan.required' => 'Pilih Tujuan !',
            'nama_driver.required' => 'Masukkan Nama Driver !',
            'no_driver.required' => 'Masukkan No. Hp Driver !',
            'nopol.required' => 'Masukkan Plat Nomor Driver !',
            'keterangan.required' => 'Masukkan Keterangan !'
        ]);

        try{
            $no_trx = $request->no_trx;
            $chars = strtoupper(Str::random(10));
            $no_surat = 'SRT'.'-'.$chars;
            DB::transaction(function () use($request,$no_trx,$no_surat){
                SuratJalan::create([
                    'no_surat' => $no_surat,
                    'no_trx' => $no_trx,
                    'id_pelanggan' => $request->id_pelanggan,
                    'nama' => $request->nama_driver,
                    'no_hp' => $request->no_driver,
                    'nopol' => $request->nopol,
                    'keterangan' => $request->keterangan
                ]);
                BarangKeluar::where('no_trx',$no_trx)->update([
                    'id_pelanggan' => $request->id_pelanggan,
                    'surat' => 1
                ]);
            });
            alert()->success('Sukses','Surat Jalan Berhasil Ditambah');
            return redirect('surat-jalan');
        }catch(Exception $e){

        }
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

    public function getpelanggan($id){
        $data = Pelanggan::where('id',$id)->get();
        if($data->isEmpty()){
            return response()->json([
                'msg' => 'gagal'
            ]);
        }
        return response()->json($data[0]);
    }

    public function cetak(){
        return view('surat_jalan.cetak');
    }
}
