<?php

namespace App\Console\Commands\BusRute;

use App\Models\BusRute;
use Illuminate\Console\Command;

class CariBusRute extends Command
{
    protected $signature = 'busrute:cari {search}';
    protected $description = 'Mencari data bus_rute berdasarkan ID Bus atau ID Rute';

    public function handle()
    {
        $search = $this->argument('search');
        $busRute = BusRute::where('id_bus', 'LIKE', "%$search%")
            ->orWhere('id_rute', 'LIKE', "%$search%")
            ->get();

        if ($busRute->isEmpty()) {
            $this->error("Data tidak ditemukan");
        } else {
            $this->table(["ID Bus Rute", "ID Bus", "ID Rute", "Created At", "Updated At"], $busRute->toArray());
        }
    }
}
