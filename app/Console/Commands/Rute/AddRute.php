<?php

namespace App\Console\Commands\Rute;

use App\Models\Rute;
use Illuminate\Console\Command;

class AddRute extends Command
{
    protected $signature = 'rute:add';
    protected $description = 'Menambahkan data rute baru';
    public function handle()
    {
        $asal = $this->ask('Asal');
        $tujuan = $this->ask('Tujuan');
        $jarak_km = $this->ask('Jarak Km');
        Rute::create([
            'asal' => $asal,
            'tujuan' => $tujuan,
            'jarak_km' => $jarak_km,
        ]);

        $this->info('Rute berhasil ditambahkan');
    }
}
