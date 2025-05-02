<?php

use App\Models\lamanutama;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\lamanutamaController;


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
Route::get('/lamanutama', [lamanutamaController::class, 'index']);
Route::get('/lamanutama/lamancreate', [lamanutamaController::class, 'create']);
Route::post('/lamanutama', [lamanutamaController::class, 'store']);
Route::get('/lamanutama/{id}/edit', [lamanutamaController::class, 'edit']);
Route::put('/lamanutama/{id}', [lamanutamaController::class, 'update']);
Route::delete('/lamanutama/{id}', [lamanutamaController::class, 'destroy']);
