<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SiswaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nis' => $this->nis,
            'nama' => $this->nama,
            'kelas' => $this->kelas ? [
                'id' => $this->kelas->id,
                'nama_kelas' => $this->kelas->nama_kelas,
            ] : null,
            'jenis_kelamin' => $this->jenisKelamin ? [
                'id' => $this->jenisKelamin->id,
                'nama' => $this->jenisKelamin->nama,
            ] : null,
        ];
    }
}
