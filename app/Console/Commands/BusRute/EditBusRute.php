<?php

namespace App\Console\Commands\BusRute;

use App\Models\BusRute;
use Illuminate\Console\Command;

class EditBusRute extends Command
{
    protected $signature = 'busrute:edit {id}';
    protected $description = 'Edit data bus_rute berdasarkan id';

    public function handle()
    {
        $id = $this->argument('id');
        $busRute = BusRute::find($id);

        if (!$busRute) {
            $this->error('Data bus_rute tidak ditemukan');
            return Command::FAILURE;
        }

        $this->info("Data saat ini");
        $this->info("ID Bus Rute: $busRute->id_bus_rute");
        $this->info("ID Bus: $busRute->id_bus");
        $this->info("ID Rute: $busRute->id_rute");

        $id_bus = $this->ask("ID Bus", $busRute->id_bus);
        $id_rute = $this->ask("ID Rute", $busRute->id_rute);

        $busRute->update([
            'id_bus' => $id_bus,
            'id_rute' => $id_rute,
        ]);

        $this->info("Data berhasil diupdate");
    }
}
