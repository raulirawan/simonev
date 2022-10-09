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
    return view('auth.login');
});

Auth::routes([
    'register' => false,
    'password.reset' => false,
    'password.request' => false,
]);

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');
});

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', 'Admin\DashboardController@index')->name('admin.dashboard.index');
    Route::resource('golongan', 'Admin\GolonganController', ['as' => 'admin'])->except('show');
    Route::resource('pegawai', 'Admin\PegawaiController', ['as' => 'admin'])->except('show');


    Route::get('laporan', 'Admin\LaporanController@index')->name('admin.laporan.index');
    Route::delete('laporan/{laporan}', 'Admin\LaporanController@destroy')->name('admin.laporan.destroy');
    Route::post('laporan/import', 'Admin\LaporanController@import')->name('admin.laporan.import');
    Route::post('laporan/export', 'Admin\LaporanController@export')->name('admin.laporan.export');
});
