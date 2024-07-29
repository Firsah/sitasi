<?php

use App\Http\Controllers\alumniController;
use Illuminate\Support\Facades\Route;

use  App\Http\Controllers\authController;
use  App\Http\Controllers\berandaController;
use App\Http\Controllers\daftarAlumniController;
use  App\Http\Controllers\userController;
use  App\Http\Controllers\StaffTrackingController;
use  App\Http\Controllers\trackingAlumniController;
use  App\Http\Controllers\responsTrackingController;

use App\Http\Controllers\sampleController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [authController::class, 'login'])->name('authController-login');
Route::post('/ProsesLogin', [authController::class, 'prosesLogin'])->name('authController-prosesLogin');
Route::get('/Logout', [authController::class, 'logout'])->name('authController-logout');

Route::get('/daftarAlumni', [daftarAlumniController::class, 'index'])->name('daftarAlumniController-index');

Route::prefix('beranda')->group(function () {
    Route::get('/', [berandaController::class, 'index'])->name('beranda_index')->middleware('auth');
    Route::get('/pertanyaan/{id}', [berandaController::class, 'fullPertanyaan'])->name('beranda_fullPertanyaan')->middleware('auth');
    Route::get('/cetakBukti/{id}', [berandaController::class, 'cetakBuktiPengisian'])->name('beranda_cetakBuktiPengisian')->middleware('auth');
});

Route::prefix('responsTracking')->middleware('auth')->group(function () {
    Route::post('/', [responsTrackingController::class, 'responsAlumni'])->name('responsTracking_responsAlumni');
});

Route::prefix('user')->middleware('auth')->group(function () {
    Route::get('/', [userController::class, 'index'])->name('user_index');
    Route::get('/tambah', [userController::class, 'tambah'])->name('user_tambah');
    Route::post('/prosesTambah', [userController::class, 'prosesTambah'])->name('user_prosesTambah');
    Route::get('/edit/{id}', [userController::class, 'edit'])->name('user_edit');
    Route::put('/prosesEdit/{id}', [userController::class, 'prosesEdit'])->name('user_prosesEdit');
    Route::delete('hapusUser/{id}', [userController::class, 'hapusUser'])->name('user_hapusUser');
});

Route::prefix('alumni')->middleware('auth')->group(function () {
    Route::get('/', [alumniController::class, 'index'])->name('alumni_index');
    Route::get('/updateData', [alumniController::class, 'update_data'])->name('alumni_updateData');
    Route::get('/detailData/{id}', [alumniController::class, 'detail_data'])->name('alumni_detailData');
});

Route::prefix('staff_tracking')->middleware('auth')->group(function () {
    Route::get('/profile', [StaffTrackingController::class, 'profile'])->name('StaffTrackingController_profile');
    Route::get('/editProfile', [StaffTrackingController::class, 'editProfile'])->name('StaffTrackingController_editProfile');
    Route::put('/prosesEditProfile', [StaffTrackingController::class, 'prosesEditProfile'])->name('StaffTrackingController_prosesEditProfile');
});

Route::prefix('tracking_alumni')->middleware('auth')->group(function () {
    Route::get('/', [trackingAlumniController::class, 'index'])->name('tracking_alumni_index');
    Route::get('/tambah', [trackingAlumniController::class, 'tambah'])->name('tracking_alumni_tambah');
    Route::post('prosesTambah', [trackingAlumniController::class, 'prosesTambah'])->name('tracking_alumni_Prosestambah');
    Route::get('/detail/{id}', [trackingAlumniController::class, 'detailPertanyaan'])->name('tracking_alumni_detailPertanyaan');
    Route::get('/publish/{id}', [trackingAlumniController::class, 'publish'])->name('tracking_alumni_publish');
    Route::post('/publish/EditOrCerate/{id}', [trackingAlumniController::class, 'editOrCreate'])->name('tracking_alumni_editOrCreate');
    Route::get('alumni/{tahun}/{jenis_pertanyaan}', [trackingAlumniController::class, 'TahunLulusDanJpertanyaan'])->name('tracking_alumni_TahunLulusDanJpertanyaan');
    Route::get('alumni/{id}', [trackingAlumniController::class, 'detailRespons'])->name('tracking_alumni_detailRespons');
    Route::get('/tambahJenisPertanyaan', [trackingAlumniController::class, 'tambahJenisPertanyaan'])->name('tracking_alumni_tambahJenisPertanyaan');
    Route::post('/ProsesTambahJenisPertanyaan', [trackingAlumniController::class, 'prosesTambahJenisPertanyaan'])->name('tracking_alumni_prosesTambahJenisPertanyaan');
    Route::get('/editJenisPertanyaan/{id}', [trackingAlumniController::class, 'editJenisPertanyaan'])->name('tracking_alumni_editJenisPertanyaan');
    Route::put('/prosesEditJenisPertanyaan/{id}', [trackingAlumniController::class, 'prosesEditJenisPertanyaan'])->name('tracking_alumni_prosesEditJenisPertanyaan');
});
