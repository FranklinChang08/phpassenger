<?php

namespace App\Console\Commands\Pemesanan;

use App\Models\Pemesanan;
use Illuminate\Console\Command;

class HapusPemesanan extends Command
{
    protected $signature = 'pemesanan:hapus {id}';
    protected $description = 'Menghapus data pemesanan berdasarkan id';

    public function handle()
    {
        $id = $this->argument('id');
        $pemesanan = Pemesanan::find($id);

        if ($pemesanan) {
            foreach ($pemesanan->has_detail_pemesanan as $detailPemesanan) {
                $kursiBus = $detailPemesanan->kursi_bus;
                if ($kursiBus) {
                    $kursiBus->status_kursi = 'available';
                    $kursiBus->save();
                }
            }
            $pemesanan->delete();
            $this->info("Pemesanan dengan ID $id berhasil dihapus.");
        } else {
            $this->error("Pemesanan dengan ID $id tidak ditemukan");
        }
    }
}
