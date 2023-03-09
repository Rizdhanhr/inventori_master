<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use Auth;
use DB;
use Hash;
use Alert;

class ManajemenUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $auth = Auth::user();
        $user = User::where('id','!=',$auth->id)->get();
        return view('manajemen_user.index',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('manajemen_user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'nama' => 'required|min:5|max:20',
            'email' => 'required|min:5|max:255',
            'role' => 'required',
            'new_password' => 'required|min:7|max:12',
            'new_confirm_password' => 'same:new_password',
        ]);
        try{
            DB::transaction(function () use($request){
                $user = new User;
                $user->name = $request->nama;
                $user->email = $request->email;
                $user->level = $request->role;
                $user->password = Hash::make($request->new_password);
                $user->save();
            });
            alert()->success('Sukses','User Ditambahkan');
            return redirect('manajemen-user');
        }catch(Exception $e){

        }
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
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('manajemen_user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            'nama' => 'required|min:5|max:20',
            'email' => 'required|min:5|max:255',
            'role' => 'required',
        ]);
        try{
            DB::transaction(function () use($request, $id){
                $user = User::findOrFail($id);
                $user->name = $request->nama;
                $user->email = $request->email;
                $user->level = $request->role;
                $user->save();
            });
            alert()->success('Sukses','User Berhasil Diupdate');
            return redirect('manajemen-user');
        }catch(Exception $e){

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            DB::transaction(function () use($id){
                $user = User::findOrFail($id);
                $user->delete();
            });
            alert()->success('Sukses','User Berhasil Dihapus!');
            return redirect()->back();
        }catch(Exception $e){

        }


    }

    public function gantipassword(Request $request, string $id){
        $this->validate($request,[
            'new_password' => 'required|min:7|max:12',
            'new_confirm_password' => 'same:new_password',
        ]);
        try{
            DB::transaction(function () use($request,$id){
                $user = User::findOrFail($id);
                $user->password = Hash::make($request->new_password);
                $user->save();
            });
            alert()->success('Sukses','Password Berhasil Diganti!');
            return redirect('manajemen-user');
        }catch(Exception $e){

        }
    }
}
