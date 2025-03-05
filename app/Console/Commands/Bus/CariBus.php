<?php

namespace App\Console\Commands;

use App\Models\Bus;
use Illuminate\Console\Command;

class CariBus extends Command
{
    protected $signature = 'bus:cari {search}';
    protected $description = 'Command description';
    public function handle()
    {
        $search = $this->argument('search');

        $bus = Bus::where("nama_bus", "LIKE", "%$search%")
            ->orWhere('plat_nomor', 'LIKE', "%$search%")
            ->orWhere('kapasitas', 'LIKE', "%$search%")
            ->orWhere('id_bus', 'LIKE', "%$search%")
            ->get();

        if ($bus->isEmpty()) {
            $this->info("Tidak menemukan data bus yang mengandung '$search'.");
        } else {
            $this->info("Hasil Pencarian Data '$search'.");
            $this->table(
                ['ID', 'Nama Bus', 'Plat Nomor', 'Kapasitas'],
                $bus->toArray()
            );
        }
    }
}
