<?php

use App\Http\Controllers\alumniController;
use Illuminate\Support\Facades\Route;

use  App\Http\Controllers\authController;
use  App\Http\Controllers\berandaController;
use  App\Http\Controllers\userController;
use App\Http\Controllers\StaffTrackingController;

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


Route::prefix('beranda')->group(function () {
    Route::get('/', [berandaController::class, 'index'])->name('beranda_index')->middleware('auth');
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
