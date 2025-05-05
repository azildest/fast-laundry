<?php

use Illuminate\Support\Facades\Route;

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