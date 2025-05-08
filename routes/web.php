<?php

use App\Models\lamanutama;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\AutentikasiAdminController;
use App\Http\Controllers\AutentikasiPembeliController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/data', function() {
//     return view('data',[
//         "sepatu" => "Nike Air Jordan",
//         "baju1" => "Uniqlo",
//         "baju2" => "Matahari",
//         "baju3" => "H&M",
//         "baju4" => "baju croptop",
//     ]);
// });
// Route::get('/lamanutama', [lamanutamaController::class, 'index']);
// Route::get('/lamanutama/lamancreate', [lamanutamaController::class, 'create']);
// Route::post('/lamanutama', [lamanutamaController::class, 'store']);
// Route::get('/lamanutama/{id}/edit', [lamanutamaController::class, 'edit']);
// Route::put('/lamanutama/{id}', [lamanutamaController::class, 'update']);
// Route::delete('/lamanutama/{id}', [lamanutamaController::class, 'destroy']);





Route::get('/admin/masuk', [AutentikasiAdminController::class, 'showLoginForm']);
Route::post('/admin/masuk', [AutentikasiAdminController::class, 'masuk']);
Route::post('/admin/keluar', [AutentikasiAdminController::class, 'keluar']);

Route::get('/admin/beranda', function () {
    return view('admin.beranda');
})->middleware('admin')->name('admin.beranda');

Route::get('/admin/produk', [ProdukController::class, 'index'])->middleware('admin')->name('admin.produk');
Route::get('/admin/produk/create', [ProdukController::class, 'create'])->middleware('admin')->name('admin.produk_create');
Route::post('/admin/produk/store', [ProdukController::class, 'store'])->middleware('admin')->name('admin.storeProduk');
Route::post('/admin/produk/update/{id}', [ProdukController::class, 'update'])->middleware('admin')->name('admin.updateProduk');
Route::post('/admin/produk/delete/{id}', [ProdukController::class, 'destroy'])->middleware('admin')->name('admin.deleteProduk');
Route::get('/admin/produk/{id}', [ProdukController::class, 'show'])->middleware('admin')->name('admin.showProduk');

Route::get('/admin/kategori', [KategoriController::class, 'index'])->name('admin.kategori');
Route::get('/admin/kategori/create', [KategoriController::class, 'create'])->name('admin.create_kategori');
Route::post('/admin/kategori', [KategoriController::class, 'store'])->name('admin.store_kategori');
Route::get('/admin/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('admin.edit_kategori');
Route::put('/admin/kategori/{id}', [KategoriController::class, 'update'])->name('admin.update_kategori');
Route::delete('/admin/kategori/{id}', [KategoriController::class, 'destroy'])->name('admin.delete_kategori');

Route::get('/admin/profil', [AdminController::class, 'profil'])->name('admin.profil');
Route::get('/admin/profil/edit', [AdminController::class, 'editProfil'])->name('admin.editprofil');
Route::post('/admin/profil/update', [AdminController::class, 'updateProfil'])->name('admin.updateprofil');

// Form login & daftar pembeli
Route::get('/pembeli/masuk', [AutentikasiPembeliController::class, 'showLoginForm'])->name('pembeli.login');
Route::post('/pembeli/masuk', [AutentikasiPembeliController::class, 'login']);
// Form pendaftaran pembeli
Route::get('/pembeli/daftar', [AutentikasiPembeliController::class, 'formDaftar'])->name('pembeli.daftar');

// Proses pendaftaran pembeli
Route::post('/pembeli/daftar', [AutentikasiPembeliController::class, 'daftar']);

// Logout
Route::post('/pembeli/keluar', [AutentikasiPembeliController::class, 'logout'])->name('pembeli.logout');

// Halaman dashboard setelah login
Route::get('/pembeli/beranda', [AutentikasiPembeliController::class, 'index'])->middleware('auth.pembeli');




