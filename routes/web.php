<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('post-logout');
Route::POST('/change-password', [App\Http\Controllers\Auth\LoginController::class, 'ubahPassword'])->name('post-change-password');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::prefix('nasabah/')->group(
    function () {
        Route::get('pengajuan-kredit', [App\Http\Controllers\KreditNasabahController::class, 'index']);
        Route::POST('checkKelayakan', [App\Http\Controllers\KreditNasabahController::class, 'checkKelayakan'])->name('checkKelayakan');
    }
);
