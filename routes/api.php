<?php

use App\Http\Controllers\Api\JenisKelaminController;
use App\Http\Controllers\Api\KelasController;
use App\Http\Controllers\Api\PendaftaranOsisController;
use App\Http\Controllers\Api\SiswaController;
use Illuminate\Support\Facades\Route;

// Endpoint Master
Route::get('/kelas', [KelasController::class, 'index']);
Route::get('/jenis-kelamin', [JenisKelaminController::class, 'index']);
Route::get('/siswa', [SiswaController::class, 'index']);

// Endpoint Pendaftaran OSIS
Route::get('/pendaftaran-osis', [PendaftaranOsisController::class, 'index']);
Route::get('/pendaftaran-osis/{id}', [PendaftaranOsisController::class, 'show']);
Route::post('/pendaftaran-osis', [PendaftaranOsisController::class, 'store']);
Route::put('/pendaftaran-osis/{id}', [PendaftaranOsisController::class, 'update']);
Route::delete('/pendaftaran-osis/{id}', [PendaftaranOsisController::class, 'destroy']);
