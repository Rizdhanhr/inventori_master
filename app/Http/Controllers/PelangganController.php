<?php

namespace App\Http\Controllers;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use DB;
use Alert;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pelanggan = Pelanggan::orderBy('created_at','desc')->get();
        return view('pelanggan.index',compact('pelanggan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pelanggan.create');
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
            'nama' => 'required|max:50',
            'no_hp' => 'required|max:20',
            'alamat' => 'required|max:100'
        ]);

        try{
            DB::transaction(function () use($request){
                $pelanggan = new Pelanggan;
                $pelanggan->nama = $request->nama;
                $pelanggan->no_hp = $request->no_hp;
                $pelanggan->alamat = $request->alamat;
                $pelanggan->save();
            });
            alert()->success('Sukses','Data Tersimpan');
            return redirect('pelanggan');
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
        $pelanggan = Pelanggan::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        return view('pelanggan.edit',compact('pelanggan'));
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
            'nama' => 'required|max:50',
            'no_hp' => 'required|max:20',
            'alamat' => 'required|max:100'
        ]);

        try{
            DB::transaction(function () use($request,$id){
                $pelanggan = Pelanggan::findOrFail($id);
                $pelanggan->nama = $request->nama;
                $pelanggan->no_hp = $request->no_hp;
                $pelanggan->alamat = $request->alamat;
                $pelanggan->save();
            });
            alert()->success('Sukses','Data Berhasil Diupdate');
            return redirect('pelanggan');
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
            DB::transaction(function () use($id){
                $pelanggan = Pelanggan::findOrFail($id);
                $pelanggan->delete();
            });
            alert()->success('Sukses','Data Terhapus');
            return redirect()->back();
        }catch(Exception $e){

        }

    }
}
