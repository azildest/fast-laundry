<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

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
    return redirect()->route('dashboard');
});

Route::get('/admin/dashboard', function () {
    return view('dashboard.dashboard');
})->name('dashboard');

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
// });
