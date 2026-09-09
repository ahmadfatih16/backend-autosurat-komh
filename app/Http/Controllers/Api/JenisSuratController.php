<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JenisSurat;
use App\Models\PenerbitSurat;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JenisSuratController extends Controller
{
    /**
     * Helper cek cepat apakah database MySQL dapat diakses tanpa blocking TCP timeout.
     */
    private function isDatabaseAccessible(): bool
    {
        static $status = null;
        if ($status !== null) {
            return $status;
        }

        $host = config('database.connections.mysql.host', '127.0.0.1');
        $port = (int) config('database.connections.mysql.port', 3306);

        $socket = @fsockopen($host, $port, $errno, $errstr, 0.3);
        if (is_resource($socket)) {
            fclose($socket);
            return $status = true;
        }

        return $status = false;
    }

    /**
     * Ambil daftar seluruh jenis surat resmi.
     */
    public function index(): JsonResponse
    {
        if ($this->isDatabaseAccessible()) {
            try {
                $jenisSurats = JenisSurat::orderBy('kode', 'asc')->get();
                return response()->json([
                    'success' => true,
                    'data' => $jenisSurats,
                ]);
            } catch (\Throwable $e) {
                // Lanjut ke fallback data standar
            }
        }

        // Fallback 15 format surat baku
        $defaultJenis = [
            ['id' => 1, 'kode' => '01', 'nama' => 'Surat keputusan (SK)', 'slug' => 'surat-keputusan-sk'],
            ['id' => 2, 'kode' => '02', 'nama' => 'Surat undangan (SU)', 'slug' => 'surat-undangan-su'],
            ['id' => 3, 'kode' => '03', 'nama' => 'Surat permohonan (SPm)', 'slug' => 'surat-permohonan-spm'],
            ['id' => 4, 'kode' => '04', 'nama' => 'Surat pemberitahuan (SPb)', 'slug' => 'surat-pemberitahuan-spb'],
            ['id' => 5, 'kode' => '05', 'nama' => 'Surat peminjaman (SPp)', 'slug' => 'surat-peminjaman-spp'],
            ['id' => 6, 'kode' => '06', 'nama' => 'Surat pernyataan (SPn)', 'slug' => 'surat-pernyataan-spn'],
            ['id' => 7, 'kode' => '07', 'nama' => 'Surat mandat (SM)', 'slug' => 'surat-mandat-sm'],
            ['id' => 8, 'kode' => '08', 'nama' => 'Surat tugas (ST)', 'slug' => 'surat-tugas-st'],
            ['id' => 9, 'kode' => '09', 'nama' => 'Surat keterangan (SKet)', 'slug' => 'surat-keterangan-sket'],
            ['id' => 10, 'kode' => '10', 'nama' => 'Surat rekomendasi (SR)', 'slug' => 'surat-rekomendasi-sr'],
            ['id' => 11, 'kode' => '11', 'nama' => 'Surat balasan (SB)', 'slug' => 'surat-balasan-sb'],
            ['id' => 12, 'kode' => '12', 'nama' => 'Surat perintah perjalanan dinas (SPPD)', 'slug' => 'surat-perintah-perjalanan-dinas-sppd'],
            ['id' => 13, 'kode' => '13', 'nama' => 'Sertifikat (SRT)', 'slug' => 'sertifikat-srt'],
            ['id' => 14, 'kode' => '14', 'nama' => 'Perjanjian kerja (PK)', 'slug' => 'perjanjian-kerja-pk'],
            ['id' => 15, 'kode' => '15', 'nama' => 'Surat pengantar (SPeng)', 'slug' => 'surat-pengantar-speng'],
        ];

        return response()->json([
            'success' => true,
            'data' => $defaultJenis,
        ]);
    }

    /**
     * Ambil daftar unit/instansi penerbit surat.
     */
    public function penerbits(): JsonResponse
    {
        if ($this->isDatabaseAccessible()) {
            try {
                $penerbits = PenerbitSurat::orderBy('kode', 'asc')->get();
                return response()->json([
                    'success' => true,
                    'data' => $penerbits,
                ]);
            } catch (\Throwable $e) {
                // Lanjut ke fallback data standar
            }
        }

        $defaultPenerbits = [
            ['id' => 1, 'kode' => 'KOMH', 'nama' => 'Pengurus Asrama Komplek H'],
            ['id' => 2, 'kode' => 'KOMH/TS', 'nama' => 'Panitia Temu Roso'],
            ['id' => 3, 'kode' => 'KOMH/SG', 'nama' => 'Panitia Stadium Generale'],
            ['id' => 4, 'kode' => 'KOMH/MK', 'nama' => 'Panitia Makrab'],
            ['id' => 5, 'kode' => 'KOMH/SL', 'nama' => 'Panitia Sunan League'],
            ['id' => 6, 'kode' => 'KOMH/PMB', 'nama' => 'Panitia Penerimaan Mahasantri Baru'],
            ['id' => 7, 'kode' => 'KOMH/ES', 'nama' => 'Panitia Komplek H E-Sport'],
            ['id' => 8, 'kode' => 'KOMH/PJL', 'nama' => 'Panitia Pemilur / Penanggung Jawab Lurah Sementara'],
        ];

        return response()->json([
            'success' => true,
            'data' => $defaultPenerbits,
        ]);
    }
}
