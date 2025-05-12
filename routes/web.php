<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FaqController;
use App\Models\Faq;
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
    return redirect()->route('visitor.visitordashboard');
});

Route::get('/visitor/beranda', function () {
    return view('visitor.visitordashboard');
})->name('visitor.visitordashboard');

Route::get('/visitor/artikel', function () {
    return view('visitor.visitorarticle');
})->name('visitor.visitorarticle');

Route::get('/visitor/kemitraan', function () {
    return view('visitor.kemitraan');
    // ganti 'landing' sesuai nama file blade-mu tanpa .blade.php
})->name('visitor.kemitraan');



Route::get('/visitor/hubungikami', function () {
    return view('visitor.hubungikami');
    // ganti 'landing' sesuai nama file blade-mu tanpa .blade.php
})->name('visitor.hubungikami');

Route::get('/', function () {
    return redirect()->route('dashboard');
});

// admin side
Route::get('/admin/dashboard', function () {
    return view('dashboard.dashboard');
})->name('dashboard');

Route::get('/admin/graphics', function () {
    return view('dashboard.graphics');
})->name('graphics');

Route::get('/faq/publikasi', [FaqController::class, 'approvalIndex'])->name('ownerfaq');


// Route::get('/admin/faq', function () {
//     return view('faq.allfaq');
// })->name('allfaq');


Route::get('/admin/sales/records', function () {
    return view('penjualan.salesview');
})->name('sales-records');

// Login Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::post('/login', function () {
    // Temporarily bypass authentication and redirect
    return redirect()->intended('/admin/dashboard');
})->name('login');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/admin/faq', [FaqController::class, 'index'])->name('allfaq');

Route::post('/faq/store', [FaqController::class, 'store'])->name('faq.store');
Route::resource('faq', \App\Http\Controllers\FaqController::class);

Route::post('/faq/{id}/status', [FaqController::class, 'updateStatus'])->name('faq.status');
Route::get('/faq/owner/approval', [FaqController::class, 'approvalIndex'])->name('faq.approval');



Route::get('/visitor/kemitraan', function () {
    $faqs = Faq::all(); // Ambil data dari tabel `faq`
    return view('visitor.kemitraan', compact('faqs'));
});

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
