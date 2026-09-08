<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Surat extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'jenis_surat_id',
        'penerbit_surat_id',
        'nomor_surat',
        'tujuan',
        'keperluan',
        'tanggal_dibuat',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_dibuat' => 'date',
        ];
    }

    /**
     * Pengguna/admin yang membuat surat.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Jenis surat yang digunakan.
     */
    public function jenisSurat(): BelongsTo
    {
        return $this->belongsTo(JenisSurat::class);
    }

    /**
     * Penerbit surat.
     */
    public function penerbitSurat(): BelongsTo
    {
        return $this->belongsTo(PenerbitSurat::class);
    }
}
