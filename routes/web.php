<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\EntitasController;
use App\Http\Controllers\KategoriProjectController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\JobTypeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\TenagaKerjaController;
use App\Http\Controllers\RkapController;
use App\Http\Controllers\PblController;
use App\Http\Controllers\PblProduksiController;
use App\Http\Controllers\UserController;

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

/**
 * Mengatur lalulintas autentikasi aplikasi
 */
Route::get('/login', [LoginController::class,'index'])->name("form-login");
Route::post('/login-proses', [LoginController::class,'login'])->name("login");
Route::get('/lupa-password', [LoginController::class,'lupa_password'])->name("lupa-password");
Route::post('/send-kode', [LoginController::class,'generate_token'])->name("send-password-token");
Route::get('/reset-password', [LoginController::class,'form_reset_password']);
Route::post('/update_password', [LoginController::class,'password_update'])->name("reset_password");
Route::get('/logout', [LoginController::class,'logout'])->name("logout");

Route::get('/',[DashboardController::class,'index'])->name("home");


/**
 * Route modul home
 */

Route::prefix('home')->group(function () {
    Route::post('/laba-rugi',[DashboardController::class,'laba_rugi'])->name("home.laba_rugi");
    // Route::get('/produksi',[DashboardController::class,'produksi'])->name("home.produksi");
    // Route::post('/produksi',[DashboardController::class,'chart_produksi'])->name("home.produksi");
    // Route::get('/produksis',[DashboardController::class,'chart_produksi'])->name("home.produksis");
});
Route::prefix('dashboard')->group(function () {
    Route::get('/dashboard-produksi',[DashboardController::class,'produksi'])->name("dashboard.produksi");
    Route::post('/dashboard-produksi',[DashboardController::class,'chart_produksi'])->name("dashboard.produksi");
    Route::get('/dashboard-keuangan',[DashboardController::class,'keuangan'])->name("dashboard.keuangan");
    Route::post('/dashboard-keuangan',[DashboardController::class,'chart_keuangan'])->name("dashboard.keuangan");
    Route::get('/dashboard-keuangans',[DashboardController::class,'chart_keuangan'])->name("dashboard.keuangans");
});

/**
 * Route modul peridoe
 */

Route::prefix('periode')->group(function () {
    Route::get('/',[PeriodeController::class,'index'])->name("periode");
    Route::get('/tambah',[PeriodeController::class,'create'])->name("periode.form-tambah");
    Route::post('/simpan',[PeriodeController::class,'store'])->name("periode.save");
    Route::put('/update_status',[PeriodeController::class,'status'])->name("periode.update_status");
    Route::get('/edit',[PeriodeController::class,'edit'])->name("periode.form-edit");
    Route::put('/edit',[PeriodeController::class,'update'])->name("periode.update");
    Route::delete('/hapus',[PeriodeController::class,'destroy'])->name("periode.delete");
});

/**
 * Route modul entitas
 */

 Route::prefix('entitas')->group(function () {
    Route::get('/',[EntitasController::class,'index'])->name("entitas");
    Route::get('/tambah',[EntitasController::class,'create'])->name("entitas.form-tambah");
    Route::post('/simpan',[EntitasController::class,'store'])->name("entitas.save");
    Route::get('/edit',[EntitasController::class,'edit'])->name("entitas.form-edit");
    Route::put('/edit',[EntitasController::class,'update'])->name("entitas.update");
    Route::delete('/hapus',[EntitasController::class,'destroy'])->name("entitas.delete");
});


/**
 * Route modul kategori project
 */

 Route::prefix('kategori-project')->group(function () {
    Route::get('/',[KategoriProjectController::class,'index'])->name("kategori_project");
    Route::get('/tambah',[KategoriProjectController::class,'create'])->name("kategori_project.form-tambah");
    Route::post('/simpan',[KategoriProjectController::class,'store'])->name("kategori_project.save");
    Route::get('/edit',[KategoriProjectController::class,'edit'])->name("kategori_project.form-edit");
    Route::put('/edit',[KategoriProjectController::class,'update'])->name("kategori_project.update");
    Route::delete('/hapus',[KategoriProjectController::class,'destroy'])->name("kategori_project.delete");
});

/**
 * Route modul project
 */

 Route::prefix('project')->group(function () {
    Route::get('/',[ProjectController::class,'index'])->name("project");
    Route::get('/tambah',[ProjectController::class,'create'])->name("project.form-tambah");
    Route::post('/simpan',[ProjectController::class,'store'])->name("project.save");
    Route::get('/edit',[ProjectController::class,'edit'])->name("project.form-edit");
    Route::put('/edit',[ProjectController::class,'update'])->name("project.update");
    Route::delete('/hapus',[ProjectController::class,'destroy'])->name("project.delete");
});


/**
 * Route modul job type
 */

 Route::prefix('job-type')->group(function () {
    Route::get('/',[JobTypeController::class,'index'])->name("job_type");
    Route::get('/tambah',[JobTypeController::class,'create'])->name("job_type.form-tambah");
    Route::post('/simpan',[JobTypeController::class,'store'])->name("job_type.save");
    Route::get('/edit',[JobTypeController::class,'edit'])->name("job_type.form-edit");
    Route::put('/edit',[JobTypeController::class,'update'])->name("job_type.update");
    Route::delete('/hapus',[JobTypeController::class,'destroy'])->name("job_type.delete");
});

/**
 * Route modul job
 */

 Route::prefix('job')->group(function () {
    Route::get('/',[JobController::class,'index'])->name("job");
    Route::get('/tambah',[JobController::class,'create'])->name("job.form-tambah");
    Route::post('/simpan',[JobController::class,'store'])->name("job.save");
    Route::get('/edit',[JobController::class,'edit'])->name("job.form-edit");
    Route::put('/edit',[JobController::class,'update'])->name("job.update");
    Route::delete('/hapus',[JobController::class,'destroy'])->name("job.delete");
});

/**
 * Route modul Tenaga Kerja
 */

 Route::prefix('tenaga-kerja')->group(function () {
    Route::get('/',[TenagaKerjaController::class,'index'])->name("tenaga_kerja");
    Route::get('/tambah',[TenagaKerjaController::class,'create'])->name("tenaga_kerja.form-tambah");
    Route::post('/simpan',[TenagaKerjaController::class,'store'])->name("tenaga_kerja.save");
    Route::get('/edit',[TenagaKerjaController::class,'edit'])->name("tenaga_kerja.form-edit");
    Route::get('/job_type',[TenagaKerjaController::class,'tipe_jabatan'])->name("tenaga_kerja.job_type");
    Route::put('/edit',[TenagaKerjaController::class,'update'])->name("tenaga_kerja.update");
    Route::delete('/hapus',[TenagaKerjaController::class,'destroy'])->name("tenaga_kerja.delete");
});


/**
 * Route modul RKAP
 */

 Route::prefix('rkap')->group(function () {
    Route::get('/',[RkapController::class,'index'])->name("rkap");
    Route::get('/tambah',[RkapController::class,'create'])->name("rkap.form-tambah");
    Route::post('/simpan',[RkapController::class,'store'])->name("rkap.save");
    Route::get('/edit',[RkapController::class,'edit'])->name("rkap.form-edit");
    Route::put('/edit',[RkapController::class,'update'])->name("rkap.update");
    Route::delete('/hapus',[RkapController::class,'destroy'])->name("rkap.delete");
});

/**
 * Route modul PBL
 */

 Route::prefix('pbl')->group(function () {
    Route::get('/',[PblController::class,'index'])->name("pbl");
    Route::get('/tambah',[PblController::class,'create'])->name("pbl.form-tambah");
    Route::post('/simpan',[PblController::class,'store'])->name("pbl.save");
    Route::get('/edit',[PblController::class,'edit'])->name("pbl.form-edit");
    Route::put('/edit',[PblController::class,'update'])->name("pbl.update");
    Route::delete('/hapus',[PblController::class,'destroy'])->name("pbl.delete");
});


/**
 * Route modul PBL PRODUKSI
 */

 Route::prefix('pbl-project')->group(function () {
    Route::get('/',[PblProduksiController::class,'index'])->name("pbl_project");
    Route::get('/tambah',[PblProduksiController::class,'create'])->name("pbl_project.form-tambah");
    Route::post('/simpan',[PblProduksiController::class,'store'])->name("pbl_project.save");
    Route::get('/edit',[PblProduksiController::class,'edit'])->name("pbl_project.form-edit");
    Route::put('/edit',[PblProduksiController::class,'update'])->name("pbl_project.update");
    Route::delete('/hapus',[PblProduksiController::class,'destroy'])->name("pbl_project.delete");
});

/**
 * Route modul PBL PRODUKSI
 */

 Route::prefix('user')->group(function () {
    Route::get('/',[UserController::class,'index'])->name("user");
    Route::get('/tambah',[UserController::class,'create'])->name("user.form-tambah");
    Route::post('/simpan',[UserController::class,'store'])->name("user.save");
    Route::get('/edit',[UserController::class,'edit'])->name("user.form-edit");
    Route::put('/edit',[UserController::class,'update'])->name("user.update");
    Route::delete('/hapus',[UserController::class,'destroy'])->name("user.delete");
});
