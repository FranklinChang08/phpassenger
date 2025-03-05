<?php

namespace App\Console\Commands\KursiBus;

use App\Models\KursiBus;
use Illuminate\Console\Command;

class CariKursiBus extends Command
{
    protected $signature = 'kursibus:cari {search}';
    protected $description = 'Mencari data kursi bus berdasarkan nomor kursi atau ID Bus';

    public function handle()
    {
        $search = $this->argument('search');
        $kursiBus = KursiBus::where('nomor_kursi', 'LIKE', "%$search%")
            ->orWhere('id_bus', 'LIKE', "%$search%")
            ->get();

        if ($kursiBus->isEmpty()) {
            $this->error("Kursi bus yang anda cari tidak ditemukan");
        } else {
            $this->info("Hasil pencarian kursi bus untuk $search ");
            $this->table(["ID", "ID Bus", "Nomor Kursi", "ID Kelas", "Status Kursi", "Created At", "Updated At"], $kursiBus->toArray());
        }
    }
}
