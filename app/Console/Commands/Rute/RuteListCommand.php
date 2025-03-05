<?php

namespace App\Console\Commands\Rute;

use App\Models\Rute;
use Illuminate\Console\Command;

class RuteListCommand extends Command
{

    protected $signature = 'rute:list';

    protected $description = 'Menampilkan list data rute';

    public function handle()
    {
        $rute = Rute::all();

        if (app()->runningInConsole()) {
            if ($rute->isEmpty()) {
                echo "rute is not found";
            } else {
                // foreach ($rute as $data) {
                //     echo "\n";
                //     echo "ID: " . $data->id_rute . "\n";
                //     echo "Asal: " . $data->asal . "\n";
                //     echo "Tujuan: " . $data->tujuan . "\n";
                //     echo "Jarak Km: " . $data->jarak_km . "\n";
                //     echo "Created At: " . $data->created_at . "\n";
                //     echo "Updated At: " . $data->updated_at . "\n";
                //     echo "----------------------------------------\n";
                // }
                $this->table(
                    ['ID', 'Asal', 'Email', 'Jarak Km', 'created_at', 'updated_at'],
                    $rute->toArray()
                );
            }
        }
    }
}
