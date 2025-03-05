<?php

namespace App\Console\Commands\Jadwal;

use App\Models\Jadwal;
use Illuminate\Console\Command;

class JadwalList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jadwal:list';

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
        $jadwal = Jadwal::all();

        if (app()->runningInConsole()) {
            if ($jadwal->isEmpty()) {
                echo "jadwal is not found";
            } else {
                $this->table(
                    ['ID', 'ID_Bus_rute', 'Tanggal', 'waktu_berangkat', 'waktu_tiba', 'created_at', 'updated_at'],
                    $jadwal->toArray()
                );
            }
        }
    }
}
