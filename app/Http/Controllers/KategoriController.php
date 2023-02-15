<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use DB;
use Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = Kategori::orderBy('created_at','desc')->get();
        return view('kategori.index',compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kategori.create');
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
            'nama' => 'required|max:255'
        ]);

        try{
            DB::transaction(function () use($request) {
                $kategori = new Kategori;
                $kategori->nama = $request->nama;
                $kategori->save();
            });

            alert()->success('Sukses','Data Tersimpan');
            return redirect('kategori');
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
        $kategori = Kategori::findOrFail($id);
        return view('kategori.edit',compact('kategori'));
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
            'nama' => 'required|max:255'
        ]);

        try{
            DB::transaction(function () use($id, $request){
                $kategori = Kategori::findOrFail($id);
                $kategori->nama = $request->nama;
                $kategori->save();
            });
            alert()->success('Sukses','Data Berhasil Diupdate');
            return redirect('kategori');
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
                $kategori = Kategori::find($id);
                $kategori->delete();
            });
            alert()->success('Sukses','Data Terhapus');
            return redirect()->back();
        }catch(Exception $e){

        }


    }
}
