<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class JenisSurat extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'kode',
        'slug',
    ];

    /**
     * Template dokumen untuk jenis surat ini.
     */
    public function template(): HasOne
    {
        return $this->hasOne(TemplateSurat::class);
    }

    /**
     * Riwayat surat yang dibuat berdasarkan jenis surat ini.
     */
    public function surats(): HasMany
    {
        return $this->hasMany(Surat::class);
    }
}
