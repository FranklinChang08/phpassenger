<?php

namespace App\Console\Commands\Jadwal;

use App\Models\Jadwal;
use Illuminate\Console\Command;

class AddJadwal extends Command
{
    protected $signature = 'jadwal:add';
    protected $description = 'Tambah data jadwal';

    public function handle()
    {
        $id_bus_rute = $this->ask("ID Bus Rute");
        $tanggal = $this->ask("Tanggal (YYYY-MM-DD)");
        $waktu_berangkat = $this->ask("Waktu Berangkat (HH:MM:SS)");
        $waktu_tiba = $this->ask("Waktu Tiba (HH:MM:SS)");

        Jadwal::create([
            'id_bus_rute' => $id_bus_rute,
            'tanggal' => $tanggal,
            'waktu_berangkat' => $waktu_berangkat,
            'waktu_tiba' => $waktu_tiba
        ]);

        $this->info("Jadwal berhasil ditambah");
    }
}
