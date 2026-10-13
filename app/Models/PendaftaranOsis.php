<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PendaftaranOsis extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran_osis';

    protected $fillable = [
        'siswa_id',
        'pilihan_bidang',
        'motivasi',
    ];

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
}
