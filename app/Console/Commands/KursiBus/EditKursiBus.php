<?php

namespace App\Console\Commands\KursiBus;

use App\Models\KursiBus;
use Illuminate\Console\Command;

class EditKursiBus extends Command
{
    protected $signature = 'kursibus:edit {id}';
    protected $description = 'Edit data kursi bus berdasarkan id';

    public function handle()
    {
        $id = $this->argument('id');
        $kursiBus = KursiBus::find($id);

        if (!$kursiBus) {
            $this->error('Kursi bus dengan ID tersebut tidak ditemukan');
            return Command::FAILURE;
        }

        $this->info("Data kursi bus saat ini dengan ID $id");
        $this->info("ID: $kursiBus->id");
        $this->info("ID Bus: $kursiBus->id_bus");
        $this->info("Nomor Kursi: $kursiBus->nomor_kursi");
        $this->info("ID Kelas: $kursiBus->id_kelas");
        $this->info("Status Kursi: $kursiBus->status_kursi");

        $id_bus = $this->ask("ID Bus", $kursiBus->id_bus);
        $nomor_kursi = $this->ask("Nomor Kursi", $kursiBus->nomor_kursi);
        $id_kelas = $this->ask("ID Kelas", $kursiBus->id_kelas);
        $status_kursi = $this->ask("Status Kursi", $kursiBus->status_kursi);

        $kursiBus->update([
            'id_bus' => $id_bus,
            'nomor_kursi' => $nomor_kursi,
            'id_kelas' => $id_kelas,
            'status_kursi' => $status_kursi
        ]);

        $this->info("Data kursi bus dengan ID $id berhasil di edit");
        return Command::SUCCESS;
    }
}
