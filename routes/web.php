<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TugasUmumController;
use App\Models\Student;

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
})->name('welcome');

Route::prefix('/data_siswa')->name('data_siswa.')->group(function(){
    Route::get('data', [StudentController::class, 'index'])->name('data');
    Route::get('/tambah', [StudentController::class, 'create'])->name('tambah');
    Route::post('/tambah/proses', [StudentController::class, 'store'])->name('tambah.proses');
    Route::get('/ubah/{id}', [StudentController::class, 'edit'])->name('ubah');
    Route::patch('/ubah/{id}/proses', [StudentController::class, 'update'])->name('ubah.proses');
    Route::delete('/hapus/{id}', [StudentController::class, 'destroy'])->name('hapus');
});

Route::prefix('/tugas_umum')->name('tugas_umum.')->group(function(){
    Route::get('tugas', [TugasUmumController::class, 'index'])->name('tugas');
    Route::get('/tambah', [TugasUmumController::class, 'create'])->name('tambah');
    Route::post('/tambah/proses', [TugasUmumController::class, 'store'])->name('tambah.proses');
    Route::get('/ubah/{id}', [TugasUmumController::class, 'edit'])->name('ubah');
    Route::patch('/ubah/{id}/proses', [TugasUmumController::class, 'update'])->name('ubah.proses');
    Route::delete('/hapus/{id}', [TugasUmumController::class, 'destroy'])->name('hapus');
});
