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

        // Fallback 16 format surat baku
        $defaultJenis = [
            ['id' => 1, 'kode' => '01', 'nama' => 'Surat Keputusan (SK)', 'slug' => 'surat-keputusan-sk'],
            ['id' => 2, 'kode' => '02', 'nama' => 'Surat Undangan (SU)', 'slug' => 'surat-undangan-su'],
            ['id' => 3, 'kode' => '03', 'nama' => 'Surat Permohonan (SPm)', 'slug' => 'surat-permohonan-spm'],
            ['id' => 4, 'kode' => '04', 'nama' => 'Surat Pemberitahuan (SPb)', 'slug' => 'surat-pemberitahuan-spb'],
            ['id' => 5, 'kode' => '05', 'nama' => 'Surat Peminjaman (SPj)', 'slug' => 'surat-peminjaman-spj'],
            ['id' => 6, 'kode' => '06', 'nama' => 'Surat Pernyataan (SP)', 'slug' => 'surat-pernyataan-sp'],
            ['id' => 7, 'kode' => '07', 'nama' => 'Surat Mandat (SM)', 'slug' => 'surat-mandat-sm'],
            ['id' => 8, 'kode' => '08', 'nama' => 'Surat Tugas (ST)', 'slug' => 'surat-tugas-st'],
            ['id' => 9, 'kode' => '09', 'nama' => 'Surat Keterangan (SKet)', 'slug' => 'surat-keterangan-sket'],
            ['id' => 10, 'kode' => '10', 'nama' => 'Surat Rekomendasi (SR)', 'slug' => 'surat-rekomendasi-sr'],
            ['id' => 11, 'kode' => '11', 'nama' => 'Surat Balasan (SB)', 'slug' => 'surat-balasan-sb'],
            ['id' => 12, 'kode' => '12', 'nama' => 'Surat Perintah Perjalanan Dinas (SPPD)', 'slug' => 'surat-perintah-perjalanan-dinas-sppd'],
            ['id' => 13, 'kode' => '13', 'nama' => 'Sertifikat (SRT)', 'slug' => 'sertifikat-srt'],
            ['id' => 14, 'kode' => '14', 'nama' => 'Perjanjian Kerja (PK)', 'slug' => 'perjanjian-kerja-pk'],
            ['id' => 15, 'kode' => '15', 'nama' => 'Surat Pengantar (SPeng)', 'slug' => 'surat-pengantar-speng'],
            ['id' => 16, 'kode' => '16', 'nama' => 'Surat Izin (SI)', 'slug' => 'surat-izin-si'],
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
            ['id' => 3, 'kode' => 'KOMH/SG', 'nama' => 'Panitia Studium Generale'],
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
