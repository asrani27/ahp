<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TkrkController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgamaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NikahController;
use App\Http\Controllers\UsahaController;
use App\Http\Controllers\DaftarController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\AdminSKController;
use App\Http\Controllers\AdminKrkController;
use App\Http\Controllers\KematianController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\KelahiranController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\PendidikanController;
use App\Http\Controllers\TpermohonanController;
use App\Http\Controllers\LupaPasswordController;
use App\Http\Controllers\DaftarLayananController;
use App\Http\Controllers\GantiPasswordController;
use App\Http\Controllers\AdminPermohonanController;

Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->hasRole('superadmin')) {
            return redirect('superadmin');
        } elseif (Auth::user()->hasRole('pemohon')) {
            return redirect('pemohon');
        }
    }
    return redirect('/login');
});

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::get('daftar', [DaftarController::class, 'index']);
Route::post('daftar', [DaftarController::class, 'daftar']);
Route::get('lupa-password', [LupaPasswordController::class, 'index']);
Route::get('/reload-captcha', [LoginController::class, 'reloadCaptcha']);
Route::get('/logout', [LogoutController::class, 'logout']);


Route::group(['middleware' => ['auth', 'role:superadmin']], function () {
    Route::get('superadmin', [HomeController::class, 'superadmin']);
    Route::get('superadmin/gp', [GantiPasswordController::class, 'index']);
    Route::post('superadmin/gp', [GantiPasswordController::class, 'update']);
    Route::post('superadmin/sk/updatelurah', [HomeController::class, 'updatelurah']);

    Route::get('superadmin/user', [AdminController::class, 'user']);
    Route::get('superadmin/user/create', [AdminController::class, 'user_create']);
    Route::post('superadmin/user/create', [AdminController::class, 'user_store']);
    Route::get('superadmin/user/edit/{id}', [AdminController::class, 'user_edit']);
    Route::post('superadmin/user/edit/{id}', [AdminController::class, 'user_update']);
    Route::get('superadmin/user/delete/{id}', [AdminController::class, 'user_delete']);

    Route::get('superadmin/kategori', [AdminController::class, 'kategori']);
    Route::get('superadmin/kategori/create', [AdminController::class, 'kategori_create']);
    Route::post('superadmin/kategori/create', [AdminController::class, 'kategori_store']);
    Route::get('superadmin/kategori/edit/{id}', [AdminController::class, 'kategori_edit']);
    Route::post('superadmin/kategori/edit/{id}', [AdminController::class, 'kategori_update']);
    Route::get('superadmin/kategori/delete/{id}', [AdminController::class, 'kategori_delete']);

    Route::get('superadmin/kepala', [AdminController::class, 'kepala']);
    Route::get('superadmin/kepala/create', [AdminController::class, 'kepala_create']);
    Route::post('superadmin/kepala/create', [AdminController::class, 'kepala_store']);
    Route::get('superadmin/kepala/edit/{id}', [AdminController::class, 'kepala_edit']);
    Route::post('superadmin/kepala/edit/{id}', [AdminController::class, 'kepala_update']);
    Route::get('superadmin/kepala/delete/{id}', [AdminController::class, 'kepala_delete']);

    Route::get('superadmin/guru', [AdminController::class, 'guru']);
    Route::get('superadmin/guru/create', [AdminController::class, 'guru_create']);
    Route::post('superadmin/guru/create', [AdminController::class, 'guru_store']);
    Route::get('superadmin/guru/edit/{id}', [AdminController::class, 'guru_edit']);
    Route::post('superadmin/guru/edit/{id}', [AdminController::class, 'guru_update']);
    Route::get('superadmin/guru/delete/{id}', [AdminController::class, 'guru_delete']);

    Route::get('superadmin/penyedia', [AdminController::class, 'penyedia']);
    Route::get('superadmin/penyedia/create', [AdminController::class, 'penyedia_create']);
    Route::post('superadmin/penyedia/create', [AdminController::class, 'penyedia_store']);
    Route::get('superadmin/penyedia/edit/{id}', [AdminController::class, 'penyedia_edit']);
    Route::post('superadmin/penyedia/edit/{id}', [AdminController::class, 'penyedia_update']);
    Route::get('superadmin/penyedia/delete/{id}', [AdminController::class, 'penyedia_delete']);

    Route::get('superadmin/ahp', [AdminController::class, 'ahp']);
    Route::get('superadmin/ahp/create', [AdminController::class, 'ahp_create']);
    Route::post('superadmin/ahp/create', [AdminController::class, 'ahp_store']);
    Route::get('superadmin/ahp/edit/{id}', [AdminController::class, 'ahp_edit']);
    Route::post('superadmin/ahp/edit/{id}', [AdminController::class, 'ahp_update']);
    Route::get('superadmin/ahp/delete/{id}', [AdminController::class, 'ahp_delete']);

    Route::get('superadmin/laporan', [AdminController::class, 'laporan']);
    Route::get('laporan/penyedia', [AdminController::class, 'lap_penyedia']);
    Route::get('laporan/kasi', [AdminController::class, 'lap_kasi']);
    Route::get('laporan/kepala', [AdminController::class, 'lap_kepala']);
    Route::get('laporan/arsip', [AdminController::class, 'lap_arsip']);
});
