<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ParokiController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\PermohonanController;
use App\Http\Controllers\PjController;
use App\Http\Controllers\BantuanController;
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
Route::get('/', [HomeController::class,'index'])->name("user.home");

Route::get('/profil', [HomeController::class,'profil'])->name("user.profil");
Route::get('/agenda', [HomeController::class,'agenda'])->name("user.agenda");
Route::get('/agenda/detail', [HomeController::class,'detail'])->name("user.agenda.detail");

Route::prefix('kotak-saran')->group(function () {
    Route::get('/',[HomeController::class,'kotak_saran'])->name("user.kotak_saran");
    Route::post('/simpan',[HomeController::class,'kotak_saran_save'])->name("user.kotak_saran_save");
});

Route::prefix('kotak-person')->group(function () {
    Route::get('/',[HomeController::class,'kotak_person'])->name("user.kotak_person");
});

Route::prefix('permohonan-bantuan')->group(function () {
    Route::get('/',[HomeController::class,'permhononan_bantuan'])->name("user.permhononan_bantuan");
    Route::post('/simpan',[HomeController::class,'permhononan_bantuan_save'])->name("user.permhononan_bantuan_save");
    Route::get('/update',[HomeController::class,'permhononan_bantuan_edit'])->name("user.permhononan_bantuan_edit");
    Route::post('/update',[HomeController::class,'permhononan_bantuan_update'])->name("user.permhononan_bantuan_update");
});
Route::prefix('pj')->group(function () {
    Route::get('/',[HomeController::class,'pj'])->name("user.pj");
    Route::post('/simpan',[HomeController::class,'pj_save'])->name("user.pj_save");
    Route::get('/update',[HomeController::class,'pj_edit'])->name("user.pj_edit");
    Route::get('/get_data',[HomeController::class,'pj_get_data'])->name("user.pj_get_data");
    Route::post('/update',[HomeController::class,'pj_update'])->name("user.pj_update");
});

/** Mengatur lalulintas autentikasi aplikasi */
Route::get('/login', [LoginController::class,'index'])->name("form-login");
Route::post('/login-proses', [LoginController::class,'login'])->name("login");
Route::get('/lupa-password', [LoginController::class,'lupa_password'])->name("lupa-password");
Route::post('/send-kode', [LoginController::class,'generate_token'])->name("send-password-token");
Route::get('/reset-password', [LoginController::class,'form_reset_password']);
Route::post('/update_password', [LoginController::class,'password_update'])->name("reset_password");
Route::post('/logout', [LoginController::class,'logout'])->name("logout");

/** Menagtur Lalulintas Admin */
Route::prefix('admin')->group(function () {
    Route::get('/',[DashboardController::class,'index'])->name("home");
    Route::get('/statistik', [DashboardController::class,'statistik'])->name("dashboard.statistik");
    Route::get('/kotak-saran',[DashboardController::class,'kotak_saran'])->name("kotak_saran");
    Route::get('/permohonan-masuk',[DashboardController::class,'permohonan_masuk'])->name("permohonan_masuk");
    Route::get('/permohonan-disetujui',[DashboardController::class,'permohonan_disetujui'])->name("permohonan_disetujui");
    Route::get('/permohonan-ditolak',[DashboardController::class,'permohonan_ditolak'])->name("permohonan_ditolak");
    Route::get('/pj-masuk',[DashboardController::class,'pj_masuk'])->name("pj_masuk");
    Route::get('/pj-disetujui',[DashboardController::class,'pj_disetujui'])->name("pj_disetujui");
    Route::get('/pj-ditolak',[DashboardController::class,'pj_ditolak'])->name("pj_ditolak");

    Route::prefix('paroki')->group(function () {
        Route::get('/',[ParokiController::class,'index'])->name("paroki");
        Route::get('/tambah',[ParokiController::class,'create'])->name("paroki.form-tambah");
        Route::post('/simpan',[ParokiController::class,'store'])->name("paroki.save");
        Route::get('/edit',[ParokiController::class,'edit'])->name("paroki.form-edit");
        Route::put('/edit',[ParokiController::class,'update'])->name("paroki.update");
        Route::delete('/hapus',[ParokiController::class,'destroy'])->name("paroki.delete");
    });

    Route::prefix('sekolah')->group(function () {
        Route::get('/',[SekolahController::class,'index'])->name("sekolah");
        Route::get('/tambah',[SekolahController::class,'create'])->name("sekolah.form-tambah");
        Route::post('/simpan',[SekolahController::class,'store'])->name("sekolah.save");
        Route::get('/edit',[SekolahController::class,'edit'])->name("sekolah.form-edit");
        Route::put('/edit',[SekolahController::class,'update'])->name("sekolah.update");
        Route::delete('/hapus',[SekolahController::class,'destroy'])->name("sekolah.delete");
    });


    Route::prefix('template')->group(function () {
        Route::get('/',[TemplateController::class,'index'])->name("template");
        Route::get('/tambah',[TemplateController::class,'create'])->name("template.form-tambah");
        Route::post('/simpan',[TemplateController::class,'store'])->name("template.save");
        Route::get('/edit',[TemplateController::class,'edit'])->name("template.form-edit");
        Route::post('/edit',[TemplateController::class,'update'])->name("template.update");
        Route::delete('/hapus',[TemplateController::class,'destroy'])->name("template.delete");
    });

    Route::prefix('kegiatan')->group(function () {
        Route::get('/',[KegiatanController::class,'index'])->name("kegiatan");
        Route::get('/tambah',[KegiatanController::class,'create'])->name("kegiatan.form-tambah");
        Route::post('/simpan',[KegiatanController::class,'store'])->name("kegiatan.save");
        Route::get('/edit',[KegiatanController::class,'edit'])->name("kegiatan.form-edit");
        Route::post('/edit',[KegiatanController::class,'update'])->name("kegiatan.update");
        Route::delete('/hapus',[KegiatanController::class,'destroy'])->name("kegiatan.delete");
    });

    Route::prefix('bantuan')->group(function () {
        Route::get('/',[BantuanController::class,'index'])->name("bantuan");
        Route::get('/tambah',[BantuanController::class,'create'])->name("bantuan.form-tambah");
        Route::post('/simpan',[BantuanController::class,'store'])->name("bantuan.save");
        Route::get('/edit',[BantuanController::class,'edit'])->name("bantuan.form-edit");
        Route::post('/edit',[BantuanController::class,'update'])->name("bantuan.update");
        Route::delete('/hapus',[BantuanController::class,'destroy'])->name("bantuan.delete");
        Route::get('/get_data',[BantuanController::class,'pj_get_data'])->name("bantuan.pj_get_data");
    });

    Route::prefix('agenda')->group(function () {
        Route::get('/',[AgendaController::class,'index'])->name("agenda");
        Route::get('/detail',[AgendaController::class,'detail'])->name("agenda.detail");
        Route::get('/kalender',[AgendaController::class,'view_kalender'])->name("agenda.kalender");
        Route::get('/tambah',[AgendaController::class,'create'])->name("agenda.form-tambah");
        Route::post('/simpan',[AgendaController::class,'store'])->name("agenda.save");
        Route::get('/edit',[AgendaController::class,'edit'])->name("agenda.form-edit");
        Route::put('/edit',[AgendaController::class,'update'])->name("agenda.update");
        Route::delete('/hapus',[AgendaController::class,'destroy'])->name("agenda.delete");
    });

    Route::prefix('profil')->group(function () {
        Route::get('/',[ProfilController::class,'index'])->name("profil");
        Route::prefix('update')->group(function () {
            Route::put('/visi_misi',[ProfilController::class,'visi_misi'])->name("profil.visi_misi");
            Route::put('/sejarah',[ProfilController::class,'sejarah'])->name("profil.sejarah");
            Route::put('/peranan',[ProfilController::class,'peranan'])->name("profil.peranan");
            Route::put('/program',[ProfilController::class,'program'])->name("profil.program");
            Route::post('/struktur',[ProfilController::class,'struktur'])->name("profil.struktur");
        });
        
    });

    Route::prefix('permohonan')->group(function () {
        Route::get('/',[PermohonanController::class,'index'])->name("permohonan");
        Route::get('/time_line',[PermohonanController::class,'timeline'])->name("permohonan.timeline");
        Route::get('/revisi',[PermohonanController::class,'permhononan_bantuan'])->name("permohonan.revisi");
        Route::post('/revisi',[PermohonanController::class,'permhononan_bantuan_save'])->name("permohonan.revisi.save");
        Route::post('/status',[PermohonanController::class,'update_status'])->name("permohonan.update_staus");
    });

    Route::prefix('laporan')->group(function () {
        Route::get('/',[PjController::class,'index'])->name("pj");
        Route::get('/revisi',[PjController::class,'pj'])->name("pj.revisi");
        Route::post('/revisi',[PjController::class,'pj_save'])->name("pj.revisi.save");
        Route::post('/status',[PjController::class,'update_status'])->name("pj.update_status");
    });

    
    
});
