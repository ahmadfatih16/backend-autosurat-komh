<?php

namespace Database\Seeders;

use App\Models\JenisSurat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class JenisSuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nama' => 'Surat keputusan (SK)', 'kode' => '01'],
            ['nama' => 'Surat undangan (SU)', 'kode' => '02'],
            ['nama' => 'Surat permohonan (SPm)', 'kode' => '03'],
            ['nama' => 'Surat pemberitahuan (SPb)', 'kode' => '04'],
            ['nama' => 'Surat peminjaman (SPp)', 'kode' => '05'],
            ['nama' => 'Surat pernyataan (SPn)', 'kode' => '06'],
            ['nama' => 'Surat mandat (SM)', 'kode' => '07'],
            ['nama' => 'Surat tugas (ST)', 'kode' => '08'],
            ['nama' => 'Surat keterangan (SKet)', 'kode' => '09'],
            ['nama' => 'Surat rekomendasi (SR)', 'kode' => '10'],
            ['nama' => 'Surat balasan (SB)', 'kode' => '11'],
            ['nama' => 'Surat perintah perjalanan dinas (SPPD)', 'kode' => '12'],
            ['nama' => 'Sertifikat (SRT)', 'kode' => '13'],
            ['nama' => 'Perjanjian kerja (PK)', 'kode' => '14'],
            ['nama' => 'Surat pengantar (SPeng)', 'kode' => '15'],
        ];

        foreach ($data as $item) {
            JenisSurat::updateOrCreate(
                ['kode' => $item['kode']],
                [
                    'nama' => $item['nama'],
                    'slug' => Str::slug($item['nama']),
                ]
            );
        }
    }
}
