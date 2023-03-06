<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Satuan;
use RealRashid\SweetAlert\Facades\Alert;
use DB;
use App\Exports\ExportSatuan;
use Maatwebsite\Excel\Facades\Excel;

class SatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $satuan = Satuan::orderBy('created_at','desc')->get();
        return view('satuan.index',compact('satuan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('satuan.create');
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
            DB::transaction(function () use($request){
                Satuan::create([
                    'nama' => $request->nama
                ]);
            });
            alert()->success('Sukses','Data Tersimpan');
            return redirect('satuan');
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
        $satuan = Satuan::findOrFail($id);
        return view('satuan.edit',compact('satuan'));
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
            DB::transaction(function () use($request,$id){
                $satuan = Satuan::findOrFail($id);
                $satuan->nama = $request->nama;
                $satuan->save();
            });
            alert()->success('Sukses','Data Berhasil Diupdate');
            return redirect('satuan');
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
                $satuan = Satuan::findOrFail($id);
                $satuan->delete();
            });
            alert()->success('Sukses','Data Terhapus');
            return redirect()->back();
        }catch(Exception $e){

        }
    }
    public function export(){
        return Excel::download(new ExportSatuan, 'satuan.xlsx');
    }
}
