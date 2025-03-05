<?php

namespace App\Console\Commands\Jadwal;

use App\Models\Jadwal;
use Illuminate\Console\Command;

class EditJadwal extends Command
{
    protected $signature = 'jadwal:edit {id}';
    protected $description = 'Edit data jadwal berdasarkan id';

    public function handle()
    {
        $id = $this->argument('id');
        $jadwal = Jadwal::find($id);

        if (!$jadwal) {
            $this->error('Jadwal dengan ID tersebut tidak ditemukan');
            return Command::FAILURE;
        }

        $this->info("Data jadwal saat ini dengan ID $id");
        $this->info("ID: $jadwal->id");
        $this->info("ID Bus Rute: $jadwal->id_bus_rute");
        $this->info("Tanggal: $jadwal->tanggal");
        $this->info("Waktu Berangkat: $jadwal->waktu_berangkat");
        $this->info("Waktu Tiba: $jadwal->waktu_tiba");

        $id_bus_rute = $this->ask("ID Bus Rute", $jadwal->id_bus_rute);
        $tanggal = $this->ask("Tanggal", $jadwal->tanggal);
        $waktu_berangkat = $this->ask("Waktu Berangkat", $jadwal->waktu_berangkat);
        $waktu_tiba = $this->ask("Waktu Tiba", $jadwal->waktu_tiba);

        $jadwal->update([
            'id_bus_rute' => $id_bus_rute,
            'tanggal' => $tanggal,
            'waktu_berangkat' => $waktu_berangkat,
            'waktu_tiba' => $waktu_tiba
        ]);

        $this->info("Jadwal dengan ID $id berhasil di edit");
        return Command::SUCCESS;
    }
}
