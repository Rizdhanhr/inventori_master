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
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\SuratJalanController;
use App\Http\Controllers\PenyesuaianController;
use App\Http\Controllers\LaporanBarangKeluarController;
use App\Http\Controllers\LaporanBarangMasukController;
use App\Http\Controllers\LaporanPenyesuaianController;
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


Route::get('/', function () {
    return view('auth.login');
});

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('login', [LoginController::class,'showLoginForm'])->name('login');
Route::post('login', [LoginController::class,'login']);
// // Registration Routes...
// Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// Route::post('register', 'Auth\RegisterController@register');
Route::post('logout', [LoginController::class,'logout'])->name('logout');
Route::middleware(['auth'])->group(function () {
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
    //Transaksi Masuk
    Route::get('/getbarang/{kode}', [BarangMasukController::class,'getbarang']);
    Route::post('/transaksi-masuk/proses' , [BarangMasukController::class, 'proses'])->name('transaksi-masuk-proses');
    Route::resource('/transaksi-masuk', BarangMasukController::class);
    //Transaksi Keluar
    Route::post('/transaksi-keluar/proses' , [BarangKeluarController::class, 'proses'])->name('transaksi-keluar-proses');
    Route::resource('/transaksi-keluar', BarangKeluarController::class);
    //Penyesuaian
    Route::post('/penyesuaian/proses' , [PenyesuaianController::class, 'proses'])->name('penyesuaian-proses');
    Route::resource('/penyesuaian',PenyesuaianController::class);
    //Surat Jalan
    Route::get('/getpelanggan/{id}',[SuratJalanController::class,'getpelanggan']);
    Route::get('/cetak-surat/{no_surat}',[SuratJalanController::class,'cetak'])->name('cetak-surat');
    Route::get('/surat-jalan-tambah/{no_trx}',[SuratJalanController::class,'create'])->name('surat-jalan-tambah');
    Route::resource('/surat-jalan', SuratJalanController::class)->except(['create']);
    //Laporan
    Route::resource('/laporan-barang-masuk',LaporanBarangMasukController::class);
    Route::resource('/laporan-barang-keluar',LaporanBarangKeluarController::class);
    Route::resource('/laporan-penyesuaian',LaporanPenyesuaianController::class);
    //Super Admin
    Route::middleware(['superAdmin'])->group(function () {
        Route::post('/change-password/{id}',[ManajemenUserController::class,'gantipassword'])->name('change-password');
        Route::resource('/manajemen-user', ManajemenUserController::class);
    });

});


