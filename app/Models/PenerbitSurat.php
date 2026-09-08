<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PenerbitSurat extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'kode',
    ];

    /**
     * Riwayat surat yang diterbitkan oleh instansi/unit ini.
     */
    public function surats(): HasMany
    {
        return $this->hasMany(Surat::class);
    }
}
