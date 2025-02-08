<?php

use App\Http\Controllers\DosenController;
use App\Http\Controllers\Kelas\KelasMatkulController;
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

    Route::resource('prodi', ProdiController::class)
        ->except(['show'])
        ->parameters(['prodi' => 'model']);
    Route::resource('mahasiswa', MahasiswaController::class)
        ->except(['show'])
        ->parameters(['mahasiswa' => 'model']);
    Route::resource('matkul', MatkulController::class)
        ->except(['show'])
        ->parameters(['matkul' => 'model']);
    Route::resource('dosen', DosenController::class)
        ->except(['show'])
        ->parameters(['dosen' => 'model']);

    Route::resource('kelas', KelasController::class)
        ->parameters(['kelas' => 'model']);


    Route::resource('kelas.matkul', KelasMatkulController::class)
        ->except(['index', 'show', 'edit', 'update'])
        ->parameters(['kelas' => 'model']);

    Route::get('/profile', 'ProfileController@index')->name('profile');
    Route::put('/profile', 'ProfileController@update')->name('profile.update');
});
