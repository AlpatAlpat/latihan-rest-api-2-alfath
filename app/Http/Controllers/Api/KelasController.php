<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\KelasResource;
use App\Models\Kelas;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class KelasController extends Controller
{
    /**
     * Menampilkan daftar master data kelas.
     */
    public function index(): AnonymousResourceCollection
    {
        $kelas = Kelas::all();

        return KelasResource::collection($kelas);
    }
}
