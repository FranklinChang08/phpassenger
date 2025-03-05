<?php

namespace App\Console\Commands\Harga;

use App\Models\Harga;
use Illuminate\Console\Command;

class HargaList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'harga:list';

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
        $harga = Harga::all();

        if (app()->runningInConsole()) {
            if ($harga->isEmpty()) {
                echo "harga is not found";
            } else {
                $this->table(
                    ['ID', 'ID_Rute', 'ID_Kelas', 'Harga', 'created_at', 'updated_at'],
                    $harga->toArray()
                );
            }
        }
    }
}
