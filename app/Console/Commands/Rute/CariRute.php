<?php

namespace App\Console\Commands\Rute;

use App\Models\Rute;
use Illuminate\Console\Command;

class CariRute extends Command
{
    protected $signature = 'rute:cari {search}';
    protected $description = 'Command description';
    public function handle()
    {
        $search = $this->argument('search');

        $rute = Rute::where("asal", "LIKE", "%$search%")
            ->orWhere('tujuan', 'LIKE', "%$search%")
            ->orWhere('id_rute', 'LIKE', "%$search%")
            ->get();

        if ($rute->isEmpty()) {
            $this->info("Tidak menemukan data rute yang mengandung '$search'.");
        } else {
            $this->info("Hasil Pencarian Data '$search'.");
            $this->table(
                ['ID', 'Asal', 'Email', 'Jarak Km'],
                $rute->toArray()
            );
        }
    }
}
