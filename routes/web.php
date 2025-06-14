<?php

use App\Models\Faq;
use App\Models\Account;
use App\Models\Article;
use App\Models\Layanan;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FaqController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsersController;

use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\DashboardController;
// use App\Http\Controllers\DashboardController;

use App\Http\Controllers\PenjualanController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::get('/visitor/beranda', [DashboardController::class, 'home'])->name('visitor.visitordashboard');

// Route::get('/visitor/artikel', function () {
//     return view('visitor.visitorarticle');
// })->name('visitor.visitorarticle');

// Artikel
Route::get('/admin/artikel', [artikelController::class, 'index'])->name('allartikel');

Route::get('/visitor/artikel', [ArtikelController::class, 'index'])->name('artikel.index');
Route::get('visitor/artikel/{id}', [ArtikelController::class, 'show'])->name('artikel.show');

Route::get('/visitor/kemitraan', function () { return view('visitor.kemitraan'); })->name('visitor.kemitraan');
Route::get('/visitor/hubungikami', function () { return view('visitor.hubungikami'); })->name('visitor.hubungikami');
Route::get('/', function () { return redirect()->route('dashboard'); });
Route::get('/visitor/kemitraan', function () { $faqs = Faq::all(); return view('visitor.kemitraan', compact('faqs')); }); // Ambil data dari tabel `faq`


// Login Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');
// Route::post('/login', function () {
//     // Temporarily bypass authentication and redirect
//     return redirect()->intended('/admin/dashboard');
// })->name('login');

// Routes for logged User
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Grafik
    Route::get('/admin/graphics', function () { return view('dashboard.graphics');})->name('graphics');

    // Sales/Penjualan
    Route::get('/admin/sales/records', [PenjualanController::class, 'index'])->name('sales.records');
    Route::post('/admin/sales/add', [PenjualanController::class, 'store'])->name('sales.add');
    Route::get('/admin/sales/data_penjualan', [PenjualanController::class, 'data_penjualan'])->name('sales.data_penjualan');
    Route::get('/admin/sales/{id_penjualan}/edit', [PenjualanController::class, 'edit'])->name('sales.edit');
    Route::put('/admin/sales/{id_penjualan}', [PenjualanController::class, 'update'])->name('sales.update');
    Route::delete('/admin/sales/delete/{id_penjualan}', [PenjualanController::class, 'delete'])->name('sales.delete');

    // Artikel
    // Halaman kelola artikel (bisa tetap pakai ini)
    Route::get('/admin/artikel/kelola', [ArtikelController::class, 'kelola'])->name('admin.artikel.kelola');
    // Store (tambah) artikel
    Route::post('/admin/artikel', [ArtikelController::class, 'store'])->name('artikel.store');
    // Update artikel
    Route::put('/admin/artikel/{id}', [ArtikelController::class, 'update'])->name('artikel.update');

    // FAQ
    Route::get('/admin/faq', [FaqController::class, 'index'])->name('allfaq');
    Route::post('/faq/store', [FaqController::class, 'store'])->name('faq.store');
    Route::resource('faq', \App\Http\Controllers\FaqController::class);
    Route::post('/faq/{id}/status', [FaqController::class, 'updateStatus'])->name('faq.status');

    // Contact/Kontak
    Route::get('/admin/contact/list', [ContactController::class, 'index'])->name('contact.list');

    // Service/Layanan
    Route::get('/admin/services/records', [LayananController::class, 'index'])->name('services.records');
    Route::get('/admin/services/data_layanan', [LayananController::class, 'data_layanan'])->name('services.data_layanan');
    Route::get('/admin/services/{id_layanan}/edit', [LayananController::class, 'edit'])->name('services.edit');
    Route::put('/admin/services/{id_layanan}', [LayananController::class, 'update'])->name('services.update');

    // Route khusus owner/level 2
    Route::middleware(['auth', 'userlevel:2'])->group(function () {
        // Menampilkan halaman publikasi artikel
        Route::get('/admin/artikel/publikasi', [ArtikelController::class, 'publikasi'])->name('admin.artikel.publikasi');
        // Menyetujui artikel
        Route::put('/admin/artikel/{id}/approve', [ArtikelController::class, 'approve'])->name('admin.artikel.approve');
        // Memblokir artikel
        Route::put('/admin/artikel/{id}/block', [ArtikelController::class, 'block'])->name('admin.artikel.block');
        // Publikasi artikel
        // Route::get('/admin/artikel/publikasi', function () {
        //     $artikels = \App\Models\Article::orderBy('created_at', 'desc')->get();
        //     return view('admin.artikel.publikasi', compact('artikels'));
        // })->name('admin.artikel.publikasi');

        // Publikasi FAQ
        Route::get('/faq/publikasi', [FaqController::class, 'approvalIndex'])->name('ownerfaq');
        Route::get('/faq/owner/approval', [FaqController::class, 'approvalIndex'])->name('faq.approval');

        // Users
        Route::get('/admin/users/list', [UsersController::class, 'index'])->name('users.list');
        Route::post('/admin/users/add', [UsersController::class, 'store'])->name('users.add');
        Route::get('/admin/users/data_users', [UsersController::class, 'data_users'])->name('users.data_users');
        // Route::get('/admin/users/{id_penjualan}/edit', [UsersController::class, 'edit'])->name('sales.edit');
        // Route::put('/admin/users/{id_penjualan}', [UsersController::class, 'update'])->name('sales.update');
        Route::delete('/admin/users/delete/{id_akun}', [UsersController::class, 'delete'])->name('users.delete');
    });
});

// Database
// Route::resource('penjualan', PenjualanController::class);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');