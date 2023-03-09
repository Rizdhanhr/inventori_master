<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use DB;
use Alert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

class GeneralSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $general = DB::table('general')->get();
        return view('general.index',compact('general'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'nama' => 'required|max:50',
            'alamat' => 'required|max:50',
            'no_telp' => 'required|numeric|min:8',
            'logo' => 'required|image|mimes:png,jpg,jpeg,svg'
        ],[
            'nama.required' => 'Masukkan Nama !',
            'alamat.required' => 'Masukkan Alamat !',
            'no_telp.required' => 'Masukkan No Telp !',
            'logo.required' => 'Masukkan Logo !',
            'logo.mimes' => 'Gambar Harus JPG, PNG, JPEG, SVG'
        ]);

        $imageName = time() . '.' . $request->logo->extension();
        $request->logo->storeAs('public/setting', $imageName);
        DB::table('general')->insert([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'logo' => $imageName
        ]);

        alert()->success('Sukses','Data Tersimpan');
        return redirect()->back();
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
    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            'nama' => 'required|max:50',
            'alamat' => 'required|max:50',
            'no_telp' => 'required|numeric|min:10',
            'logo' => 'mimes:png,jpg,jpeg,svg'
        ],[
            'nama.required' => 'Masukkan Nama !',
            'alamat.required' => 'Masukkan Alamat !',
            'no_telp.required' => 'Masukkan No Telp !',
            'logo.mimes' => 'Gambar Harus JPG, PNG, JPEG, SVG'
        ]);

        $post = DB::table('general')->where('id',$id)->first();
        $imageName = '';
        if ($request->hasFile('logo')) {
        $imageName = time() . '.' . $request->logo->extension();
        $request->logo->storeAs('public/setting', $imageName);
            if ($post->logo) {
                Storage::delete('public/setting/' . $post->logo);
            }
        } else {
        $imageName = $post->logo;
        }
        DB::table('general')->where('id',$id)->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'logo' => $imageName
        ]);
        alert()->success('Sukses','Data Tersimpan');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
