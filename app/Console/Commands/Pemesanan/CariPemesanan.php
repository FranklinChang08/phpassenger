<?php

namespace App\Console\Commands;

use App\Models\Pemesanan;
use Illuminate\Console\Command;

class CariPemesanan extends Command
{
    protected $signature = 'pemesanan:cari {search}';
    protected $description = 'Mencari data pemesanan berdasarkan ID Pengguna atau ID Jadwal';

    public function handle()
    {
        $search = $this->argument('search');
        $pemesanan = Pemesanan::where('id_pengguna', 'LIKE', "%$search%")
            ->orWhere('id_jadwal', 'LIKE', "%$search%")
            ->get();

        if ($pemesanan->isEmpty()) {
            $this->error("Pemesanan yang anda cari tidak ditemukan");
        } else {
            $this->info("Hasil pencarian pemesanan untuk $search ");
            $this->table(["ID", "ID Pengguna", "ID Jadwal", "Tanggal Pemesanan", "Status", "Created At", "Updated At"], $pemesanan->toArray());
        }
    }
}
