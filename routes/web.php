<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DetailUserController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ManajemenUserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('login', [LoginController::class,'showLoginForm'])->name('login');
Route::post('login', [LoginController::class,'login']);


// // Registration Routes...
// Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// Route::post('register', 'Auth\RegisterController@register');

Route::middleware(['auth'])->group(function () {
    Route::post('logout', [LoginController::class,'logout'])->name('logout');
    //Dashboard
    Route::resource('/dashboard', DashboardController::class);

    //Atribut Barang
    Route::resource('/kategori', KategoriController::class);
    Route::resource('/brand', BrandController::class);
    Route::resource('/satuan', SatuanController::class);

    //Barang
    Route::resource('/barang', BarangController::class);

    //Edit Profil
    Route::post('/ganti-password',[DetailUserController::class,'gantipassword'])->name('ganti-password');
    Route::resource('/user', DetailUserController::class);

    //Supplier Dan Pelanggan
    Route::resource('/pelanggan', PelangganController::class);
    Route::resource('/supplier', SupplierController::class);

    //Super Admin
    Route::middleware(['superAdmin'])->group(function () {
        Route::post('/change-password/{id}',[ManajemenUserController::class,'gantipassword'])->name('change-password');
        Route::resource('/manajemen-user', ManajemenUserController::class);
    });

});


