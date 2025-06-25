<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TiketController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FormTiketController;
use App\Http\Controllers\AdminPemesanController;

// ==============================
// Halaman Utama
// ==============================
Route::get('/', [FormTiketController::class, 'index'])->name('beranda');
Route::post('/proses', [FormTiketController::class, 'process'])->name('tiket.process');
Route::post('/check-payment', [FormTiketController::class, 'checkPayment'])->name('tiket.check_payment');
Route::post('/reset', [FormTiketController::class, 'reset'])->name('tiket.reset');

 //==============================
// Hasil Pemesanan
//===============================
Route::get('/hasil', function () {
    return view('hasil');
})->name('tiket.result');



// ==============================
// Login & Register
// ==============================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// ==============================
// Login Admin
// ==============================
Route::get('/login-admin', [AdminLoginController::class, 'showLoginForm'])->name('admin.login.form');
Route::post('/login-admin', [AdminLoginController::class, 'login'])->name('admin.login.submit');

// ==============================
// Admin (dengan prefix dan auth)
// ==============================
Route::prefix('admin')->middleware('auth')->group(function () {

    // pemesan
    Route::get('/pemesan', [AdminPemesanController::class, 'index'])->name('admin.pemesan.index');
    Route::get('/pemesan/{id}/edit', [AdminPemesanController::class, 'edit'])->name('admin.pemesan.edit');
    Route::put('/pemesan/{id}', [AdminPemesanController::class, 'update'])->name('admin.pemesan.update');
    Route::delete('/pemesan/{id}', [AdminPemesanController::class, 'destroy'])->name('admin.pemesan.destroy');

    // check-in admin
    Route::get('/checkin', [TiketController::class, 'showCheckinForm'])->name('checkin.form');
    Route::post('/checkin', [TiketController::class, 'processCheckin'])->name('checkin.process');
});

