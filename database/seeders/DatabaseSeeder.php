<?php

namespace Database\Seeders;

use App\Models\PenerbitSurat;
use App\Models\Pengaturan;
use App\Models\TemplateSurat;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Jenis Surat
        $this->call(JenisSuratSeeder::class);

        // 2. Seed Default User (Pengurus)
        User::updateOrCreate(
            ['email' => 'admin@autosurat.com'],
            [
                'name' => 'Pengurus AutoSurat',
                'password' => Hash::make('password'),
            ]
        );

        // 3. Seed Penerbit Surat (8 Unit Asrama Komplek H)
        $penerbits = [
            ['nama' => 'Pengurus Asrama Komplek H', 'kode' => 'KOMH'],
            ['nama' => 'Panitia Temu Roso', 'kode' => 'KOMH/TS'],
            ['nama' => 'Panitia Studium Generale', 'kode' => 'KOMH/SG'],
            ['nama' => 'Panitia Makrab', 'kode' => 'KOMH/MK'],
            ['nama' => 'Panitia Sunan League', 'kode' => 'KOMH/SL'],
            ['nama' => 'Panitia Penerimaan Mahasantri Baru', 'kode' => 'KOMH/PMB'],
            ['nama' => 'Panitia Komplek H E-Sport', 'kode' => 'KOMH/ES'],
            ['nama' => 'Panitia Pemilur / Penanggung Jawab Lurah Sementara', 'kode' => 'KOMH/PJL'],
        ];
        foreach ($penerbits as $penerbit) {
            PenerbitSurat::updateOrCreate(['kode' => $penerbit['kode']], $penerbit);
        }

        // 4. Seed Pengaturan default
        Pengaturan::updateOrCreate(
            ['kunci' => 'nama_instansi'],
            ['nilai' => 'AutoSurat KOMH']
        );
        Pengaturan::updateOrCreate(
            ['kunci' => 'alamat_instansi'],
            ['nilai' => 'Surabaya, Jawa Timur']
        );
    }
}
