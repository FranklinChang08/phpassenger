<?php

namespace App\Console\Commands\Harga;

use App\Models\Harga;
use Illuminate\Console\Command;

class AddHarga extends Command
{
    protected $signature = 'harga:add';
    protected $description = 'Tambah data harga';

    public function handle()
    {
        $id_rute = $this->ask("ID Rute");
        $id_kelas = $this->ask("ID Kelas");
        $harga = $this->ask("Harga");

        Harga::create([
            'id_rute' => $id_rute,
            'id_kelas' => $id_kelas,
            'harga' => $harga
        ]);

        $this->info("Harga berhasil ditambah");
    }
}
