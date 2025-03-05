<?php

namespace App\Console\Commands\BusRute;

use App\Models\BusRute;
use Illuminate\Console\Command;

class BusRuteList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'busrute:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $busrute = BusRute::all();

        if (app()->runningInConsole()) {
            if ($busrute->isEmpty()) {
                echo "busrute is not found";
            } else {
                // foreach ($busrute as $data) {
                //     echo "\n";
                //     echo "ID: " . $data->id_busrute . "\n";
                //     echo "Asal: " . $data->asal . "\n";
                //     echo "Tujuan: " . $data->tujuan . "\n";
                //     echo "Jarak Km: " . $data->jarak_km . "\n";
                //     echo "Created At: " . $data->created_at . "\n";
                //     echo "Updated At: " . $data->updated_at . "\n";
                //     echo "----------------------------------------\n";
                // }
                $this->table(
                    ['ID', 'ID_Bus', 'ID_Rute', 'created_at', 'updated_at'],
                    $busrute->toArray()
                );
            }
        }
    }
}
