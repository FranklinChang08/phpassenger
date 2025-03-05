<?php

namespace App\Console\Commands\Harga;

use App\Models\Harga;
use Illuminate\Console\Command;

class EditHarga extends Command
{
    protected $signature = 'harga:edit {id}';
    protected $description = 'Edit data harga berdasarkan id';

    public function handle()
    {
        $id = $this->argument('id');
        $harga = Harga::find($id);

        if (!$harga) {
            $this->error('Harga dengan ID tersebut tidak ditemukan');
            return Command::FAILURE;
        }

        $this->info("Data harga saat ini dengan ID $id");
        $this->info("ID: $harga->id");
        $this->info("ID Rute: $harga->id_rute");
        $this->info("ID Kelas: $harga->id_kelas");
        $this->info("Harga: $harga->harga");

        $id_rute = $this->ask("ID Rute", $harga->id_rute);
        $id_kelas = $this->ask("ID Kelas", $harga->id_kelas);
        $harga_value = $this->ask("Harga", $harga->harga);

        $harga->update([
            'id_rute' => $id_rute,
            'id_kelas' => $id_kelas,
            'harga' => $harga_value
        ]);

        $this->info("Data harga dengan ID $id berhasil di edit");
        return Command::SUCCESS;
    }
}
