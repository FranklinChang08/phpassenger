<?php

namespace App\Console\Commands\KursiBus;

use App\Models\KursiBus;
use Illuminate\Console\Command;

class KursiBusList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kursibus:list';

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
        $kursibus = KursiBus::all();

        if (app()->runningInConsole()) {
            if ($kursibus->isEmpty()) {
                echo "kursibus is not found";
            } else {
                $this->table(
                    ['ID', 'ID_Bus', 'Nomor Kursi', 'ID_Kelas', 'Status', 'created_at', 'updated_at'],
                    $kursibus->toArray()
                );
            }
        }
    }
}
