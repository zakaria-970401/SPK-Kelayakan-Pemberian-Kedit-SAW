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
Route::get('/masterbunga', [App\Http\Controllers\KreditNasabahController::class, 'masterbunga']);
Route::get('/updatebunga/{value}', [App\Http\Controllers\KreditNasabahController::class, 'updatebunga']);
Route::prefix('nasabah/')->group(
    function () {
        Route::get('pengajuan-kredit', [App\Http\Controllers\KreditNasabahController::class, 'index']);
        Route::POST('checkKelayakan', [App\Http\Controllers\KreditNasabahController::class, 'checkKelayakan'])->name('checkKelayakan');
        Route::POST('postKredit', [App\Http\Controllers\KreditNasabahController::class, 'postKredit']);
        Route::get('checkNominal/{nominal}', [App\Http\Controllers\KreditNasabahController::class, 'checkNominal']);
        Route::get('printout/{id_nasabah}', [App\Http\Controllers\KreditNasabahController::class, 'printout']);
        Route::get('list-jatuh-tempo', [App\Http\Controllers\KreditNasabahController::class, 'listJatuhTempo']);
        Route::POST('postPembayaran', [App\Http\Controllers\KreditNasabahController::class, 'postPembayaran']);
        Route::get('list-kredit-aktif', [App\Http\Controllers\KreditNasabahController::class, 'listKreditAktif']);
        Route::get('list-kredit-aktif', [App\Http\Controllers\KreditNasabahController::class, 'listKreditAktif']);
        Route::get('tracePembayaran/{id}', [App\Http\Controllers\KreditNasabahController::class, 'tracePembayaran']);
        Route::get('simulasi-kelayakan', [App\Http\Controllers\KreditNasabahController::class, 'simulasiKelayakan']);
        Route::POST('result-simulasi-kelayakan', [App\Http\Controllers\KreditNasabahController::class, 'resultSimulasiKelayakan']);
        Route::get('permintaan-hapus-data', [App\Http\Controllers\KreditNasabahController::class, 'permintaanHapusData']);
        Route::get('sendPermintaanHapus/{id_nasabah}', [App\Http\Controllers\KreditNasabahController::class, 'sendPermintaanHapus']);
        Route::get('tableHasilPerhitungan', [App\Http\Controllers\KreditNasabahController::class, 'tableHasilPerhitungan']);
        Route::get('showHasilPerhitungan/{created_at}', [App\Http\Controllers\KreditNasabahController::class, 'showHasilPerhitungan']);
    }
);


Route::prefix('superadmin')->group(function () {
    Route::get('/user', [App\Http\Controllers\SuperAdminController::class, 'masterUser']);
    Route::get('/deleteUser/{id}', [App\Http\Controllers\SuperAdminController::class, 'deleteUser']);
    Route::POST('/post_user', [App\Http\Controllers\SuperAdminController::class, 'postUser']);
    Route::get('/showUser/{id}', [App\Http\Controllers\SuperAdminController::class, 'showUser']);
    Route::get('/resetPassword/{id}', [App\Http\Controllers\SuperAdminController::class, 'resetPassword']);
    Route::POST('/updateUser', [App\Http\Controllers\SuperAdminController::class, 'updateUser']);
    Route::get('/menu', [App\Http\Controllers\SuperAdminController::class, 'aksesMenu']);
    Route::get('/master_bobot', [App\Http\Controllers\SuperAdminController::class, 'masterBobot']);
    Route::get('/editKriteria/{id}', [App\Http\Controllers\SuperAdminController::class, 'editKriteria']);
    Route::POST('/updateKriteria', [App\Http\Controllers\SuperAdminController::class, 'updateKriteria']);
    Route::get('/editSubKriteria/{id}', [App\Http\Controllers\SuperAdminController::class, 'editSubKriteria']);
    Route::POST('/updatesubKriteria', [App\Http\Controllers\SuperAdminController::class, 'updatesubKriteria']);
});

Route::prefix('permission/')->group(function () {
    Route::get('/', [App\Http\Controllers\PermissionController::class, 'index'])->name('permissions.index');
    Route::post('/add', [App\Http\Controllers\PermissionController::class, 'store'])->name('permission.add');
    Route::post('/add_group', [App\Http\Controllers\PermissionController::class, 'add_group'])->name('permission.add_group');
    Route::get('/lihat_permission/{id}', [App\Http\Controllers\PermissionController::class, 'lihat_permission']);
    Route::post('/add_group_permission', [App\Http\Controllers\PermissionController::class, 'add_group_permission'])->name('permission.add_group_permission');
    Route::get('/hapus_permission/{kategori}/{id}', [App\Http\Controllers\PermissionController::class, 'hapus_permission']);
    Route::get('/update_permission/{kategori}/{nama}/{id}', [App\Http\Controllers\PermissionController::class, 'update_permission']);
});

Route::prefix('report/')->group(function () {
    Route::get('/', [App\Http\Controllers\ReportController::class, 'index']);
});
