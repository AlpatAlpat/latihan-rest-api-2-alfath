<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SiswaResource;
use App\Models\Siswa;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SiswaController extends Controller
{
    /**
     * Menampilkan daftar master data siswa beserta relasi kelas dan jenis kelamin.
     */
    public function index(): AnonymousResourceCollection
    {
        $siswa = Siswa::with(['kelas', 'jenisKelamin'])->get();

        return SiswaResource::collection($siswa);
    }
}
