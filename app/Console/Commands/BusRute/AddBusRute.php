<?php

namespace App\Console\Commands\BusRute;

use App\Models\BusRute;
use Illuminate\Console\Command;

class AddBusRute extends Command
{
    protected $signature = 'busrute:add';
    protected $description = 'Tambah data bus_rute';

    public function handle()
    {
        $id_bus = $this->ask("ID Bus");
        $id_rute = $this->ask("ID Rute");

        BusRute::create([
            'id_bus' => $id_bus,
            'id_rute' => $id_rute,
        ]);

        $this->info("Bus_rute berhasil ditambah");
    }
}
