<?php

namespace App\Console\Commands\Harga;

use App\Models\Harga;
use Illuminate\Console\Command;

class CariHarga extends Command
{
    protected $signature = 'harga:cari {search}';
    protected $description = 'Mencari data harga berdasarkan ID Rute atau ID Kelas';

    public function handle()
    {
        $search = $this->argument('search');
        $harga = Harga::where('id_rute', 'LIKE', "%$search%")
            ->orWhere('id_kelas', 'LIKE', "%$search%")
            ->get();

        if ($harga->isEmpty()) {
            $this->error("Harga yang anda cari tidak ditemukan");
        } else {
            $this->info("Hasil pencarian harga untuk $search ");
            $this->table(["ID", "ID Rute", "ID Kelas", "Harga", "Created At", "Updated At"], $harga->toArray());
        }
    }
}
