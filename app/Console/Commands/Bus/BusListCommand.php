<?php

namespace App\Console\Commands;

use App\Models\Bus;
use Illuminate\Console\Command;

class BusListCommand extends Command
{

    protected $signature = 'bus:list';

    protected $description = 'Menampilkan list data bus';

    public function handle()
    {
        $bus = Bus::all();

        if (app()->runningInConsole()) {
            if ($bus->isEmpty()) {
                echo "Bus is not found";
            } else {
                // foreach ($bus as $data) {
                //     echo "\n";
                //     echo "ID: " . $data->id_bus . "\n";
                //     echo "Nama Bus: " . $data->nama_bus . "\n";
                //     echo "Plat Nomor: " . $data->plat_nomor . "\n";
                //     echo "Kapasitas: " . $data->kapasitas . "\n";
                //     echo "Created At: " . $data->created_at . "\n";
                //     echo "Updated At: " . $data->updated_at . "\n";
                //     echo "----------------------------------------\n";
                // }
                $this->table(
                    ['ID', 'Nama Bus', 'Plat Nomor', 'Kapasitas', 'created_at', 'updated_at'],
                    $bus->toArray()
                );
            }
        }
    }
}
