<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alert;
use DB;
use App\Models\Supplier;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier = Supplier::orderByDesc('created_at')->get();
        return view('supplier.index',compact('supplier'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('supplier.create');
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
                $supplier = new Supplier;
                $supplier->nama = $request->nama;
                $supplier->no_hp = $request->no_hp;
                $supplier->alamat = $request->alamat;
                $supplier->save();
            });
            alert()->success('Sukses','Data Tersimpan');
            return redirect('supplier');
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
        $supplier = Supplier::findOrFail($id);
        return view('supplier.edit',compact('supplier'));
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
                $supplier = Supplier::findOrFail($id);
                $supplier->nama = $request->nama;
                $supplier->no_hp = $request->no_hp;
                $supplier->alamat = $request->alamat;
                $supplier->save();
            });
            alert()->success('Sukses','Data Berhasil Diupdate');
            return redirect('supplier');
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
                $supplier = Supplier::findOrFail($id);
                $supplier->delete();
            });
            alert()->success('Sukses','Data Terhapus');
            return redirect()->back();
        }catch(Exception $e){

        }

    }
}
