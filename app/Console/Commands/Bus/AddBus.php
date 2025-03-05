<?php

namespace App\Console\Commands;

use App\Models\Bus;
use Illuminate\Console\Command;

class AddBus extends Command
{
    protected $signature = 'bus:add';
    protected $description = 'Menambahkan data rute baru';
    public function handle()
    {
        $nama_bus = $this->ask('Nama Bus');
        $plat_nomor = $this->ask('Plat Nomor');
        $kapasitas = $this->ask('Kapasitas');
        Bus::create([
            'nama_bus' => $nama_bus,
            'plat_nomor' => $plat_nomor,
            'kapasitas' => $kapasitas,
        ]);

        $this->info('Bus berhasil ditambahkan');
    }
}
