<?php

use App\Models\lamanutama;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use PHPUnit\Event\Application\Finished;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KeranjangController;
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


Route::middleware('admin')->group(function () {
    Route::get('/admin/beranda', [AdminController::class, 'beranda'])->name('admin.beranda');
    // ... other admin routes
});
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

Route::middleware('admin')->group(function () {
    Route::get('/admin/pesanan', [PesananController::class, 'index'])->name('admin.pesanan');
    Route::get('/admin/pesanan/{id}', [PesananController::class, 'show'])->name('admin.pesanan.show');
    Route::post('/admin/pesanan/{id}/update-status', [PesananController::class, 'updateStatus'])->name('admin.pesanan.update-status');
    Route::post('admin/pesanan/hapus/{id}', [PesananController::class, 'hapusPesanan'])->name('admin.pesanan.hapus');
});

Route::get('/admin/profil', [AdminController::class, 'profil'])->name('admin.profil');
Route::get('/admin/profil/edit', [AdminController::class, 'editProfil'])->name('admin.editprofil');
Route::post('/admin/profil/update', [AdminController::class, 'updateProfil'])->name('admin.updateprofil');

Route::get('/pembeli/masuk', [AutentikasiPembeliController::class, 'showLoginForm'])->name('pembeli.login');
Route::post('/pembeli/masuk', [AutentikasiPembeliController::class, 'login']);
Route::get('/pembeli/daftar', [AutentikasiPembeliController::class, 'formDaftar'])->name('pembeli.daftar');
Route::post('/pembeli/daftar', [AutentikasiPembeliController::class, 'daftar']);
Route::post('/pembeli/keluar', [AutentikasiPembeliController::class, 'logout'])->name('pembeli.logout');
Route::get('/pembeli/beranda', [AutentikasiPembeliController::class, 'index'])->middleware('auth.pembeli');
Route::get('/pembeli/beranda', [PembeliController::class, 'beranda'])->middleware('auth.pembeli')->name('pembeli.beranda');

Route::get('/pembeli/profil', [PembeliController::class, 'profil'])->name('pembeli.profil');
Route::get('/pembeli/profil/edit', [PembeliController::class, 'editProfil'])->name('pembeli.editprofil');
Route::put('/pembeli/profil/update', [PembeliController::class, 'updateProfil'])->name('pembeli.updateprofil');

Route::get('/clear-cache', function(){
    $run = Artisan::call('config:clear');
    $run = Artisan::call('cache:clear');
    $run = Artisan::call('config:cache');
});

Route::middleware('auth.pembeli')->group(function () {
    Route::post('/pembeli/keranjang/checkout', [KeranjangController::class, 'checkout'])->name('pembeli.keranjang.checkout');
    Route::get('/pembeli/keranjang', [KeranjangController::class, 'index'])->name('pembeli.keranjang.index');
    Route::post('/pembeli/keranjang/tambah/{id}', [KeranjangController::class, 'tambah'])->name('pembeli.keranjang.tambah');
    Route::delete('/pembeli/keranjang/{id}', [KeranjangController::class, 'hapus'])->name('pembeli.keranjang.hapus');
    
});



