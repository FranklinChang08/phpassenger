<?php

namespace App\Console\Commands\KursiBus;

use App\Models\KursiBus;
use Illuminate\Console\Command;

class AddKursiBus extends Command
{
    protected $signature = 'kursibus:add';
    protected $description = 'Tambah data kursi bus';

    public function handle()
    {
        $id_bus = $this->ask("ID Bus");
        $nomor_kursi = $this->ask("Nomor Kursi");
        $id_kelas = $this->ask("ID Kelas");
        $status_kursi = $this->ask("Status Kursi");

        KursiBus::create([
            'id_bus' => $id_bus,
            'nomor_kursi' => $nomor_kursi,
            'id_kelas' => $id_kelas,
            'status_kursi' => $status_kursi
        ]);

        $this->info("Kursi bus berhasil ditambah");
    }
}
