<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JenisKelamin extends Model
{
    use HasFactory;

    protected $table = 'jenis_kelamin';

    protected $fillable = [
        'nama',
    ];

    public function siswa(): HasMany
    {
        return $this->hasMany(Siswa::class, 'jenis_kelamin_id');
    }
}
