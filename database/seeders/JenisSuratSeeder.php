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
            ['nama' => 'Surat Keputusan (SK)', 'kode' => '01'],
            ['nama' => 'Surat Undangan (SU)', 'kode' => '02'],
            ['nama' => 'Surat Permohonan (SPm)', 'kode' => '03'],
            ['nama' => 'Surat Pemberitahuan (SPb)', 'kode' => '04'],
            ['nama' => 'Surat Peminjaman (SPj)', 'kode' => '05'],
            ['nama' => 'Surat Pernyataan (SP)', 'kode' => '06'],
            ['nama' => 'Surat Mandat (SM)', 'kode' => '07'],
            ['nama' => 'Surat Tugas (ST)', 'kode' => '08'],
            ['nama' => 'Surat Keterangan (SKet)', 'kode' => '09'],
            ['nama' => 'Surat Rekomendasi (SR)', 'kode' => '10'],
            ['nama' => 'Surat Balasan (SB)', 'kode' => '11'],
            ['nama' => 'Surat Perintah Perjalanan Dinas (SPPD)', 'kode' => '12'],
            ['nama' => 'Sertifikat (SRT)', 'kode' => '13'],
            ['nama' => 'Perjanjian Kerja (PK)', 'kode' => '14'],
            ['nama' => 'Surat Pengantar (SPeng)', 'kode' => '15'],
            ['nama' => 'Surat Izin (SI)', 'kode' => '16'],
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
