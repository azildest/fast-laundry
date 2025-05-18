<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PenjualanController;

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

// Visitor
Route::get('/', function () {
    return redirect()->route('visitor.visitordashboard');
});

Route::get('/visitor/beranda', function () {
    return view('visitor.visitordashboard');
})->name('visitor.visitordashboard');

Route::get('/visitor/artikel', function () {
    return view('visitor.visitorarticle');
})->name('visitor.visitorarticle');

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/kemitraan', function () {
    return view('layouts.components.kemitraan');
    // ganti 'landing' sesuai nama file blade-mu tanpa .blade.php
})->name('kemitraan');

Route::get('/footer', function () {
    return view('layouts.components.footer');
    // ganti 'landing' sesuai nama file blade-mu tanpa .blade.php
})->name('footer');

Route::get('/HubungiKami', function () {
    return view('layouts.components.HubungiKami');
    // ganti 'landing' sesuai nama file blade-mu tanpa .blade.php
})->name('HubungiKami');
// Visitor

// Admin/Owner side
// Dashboard
Route::get('/admin/dashboard', function () {
    return view('dashboard.dashboard');
})->name('dashboard');

// Sales/Penjualan
Route::get('/admin/sales/records', [PenjualanController::class, 'index'])->name('sales.records');
Route::post('/admin/sales/add', [PenjualanController::class, 'store'])->name('sales.add');
Route::get('/admin/sales/data_penjualan', [PenjualanController::class, 'data_penjualan'])->name('sales.data_penjualan');
Route::get('/admin/sales/{id_penjualan}/edit', [PenjualanController::class, 'edit'])->name('sales.edit');
Route::put('/admin/sales/{id_penjualan}', [PenjualanController::class, 'update'])->name('sales.update');
Route::post('/admin/sales/delete/{id_penjualan}', [PenjualanController::class, 'delete'])->name('sales.delete');

// Login Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', function () {
    // Temporarily bypass authentication and redirect
    return redirect()->intended('/admin/dashboard');
})->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// // Routes for Owner
// Route::middleware(['auth', 'userlevel:2'])->group(function () {
//     Route::get('/admin/dashboard', function () {
//         return view('dashboard.dashboard');
//     });
// });

// // Routes for Admin
// Route::middleware(['auth', 'userlevel:1'])->group(function () {
//     Route::get('/admin/dashboard', function () {
//         return view('dashboard.dashboard');
//     });
// Admin/Owner side

// Database
Route::resource('penjualan', PenjualanController::class);
