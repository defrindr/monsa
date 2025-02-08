<?php

use App\Http\Controllers\DosenController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MatkulController;
use App\Http\Controllers\ProdiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false, 'reset' => false, 'confirm' => false]);

Route::name('admin.')->middleware('auth')->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('prodi', ProdiController::class)->parameters(['prodi' => 'model']);
    Route::resource('mahasiswa', MahasiswaController::class)->parameters(['mahasiswa' => 'model']);
    Route::resource('matkul', MatkulController::class)->parameters(['matkul' => 'model']);
    Route::resource('dosen', DosenController::class)->parameters(['dosen' => 'model']);

    Route::resource('kelas', KelasController::class)->parameters(['kelas' => 'model']);

    Route::get('/profile', 'ProfileController@index')->name('profile');
    Route::put('/profile', 'ProfileController@update')->name('profile.update');
});
