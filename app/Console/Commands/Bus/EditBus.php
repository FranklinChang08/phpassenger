<?php

namespace App\Console\Commands;

use App\Models\Bus;
use Illuminate\Console\Command;

class EditBus extends Command
{
    protected $signature = 'bus:edit {id}';
    protected $description = 'Command description';
    public function handle()
    {
        $id = $this->argument('id');
        $bus = Bus::find($id);

        if (!$bus) {
            $this->error('bus tidak ditemukan');
            return Command::FAILURE;
        }

        $this->info('Data bus saat ini: ');
        $this->info("Nama Bus: {$bus->nama_bus}");
        $this->info("Plat Nomor: {$bus->plat_nomor}");
        $this->info("Kapasitas: {$bus->kapasitas}");

        $nama_bus = $this->ask('Nama Bus baru (kosongkan untuk tetap sama)', $bus->nama_bus);
        $plat_nomor = $this->ask('Plat Nomor baru (kosongkan untuk tetap sama)', $bus->plat_nomor);
        $kapasitas = $this->ask('Kapasitas baru (kosongkan untuk tetap sama)', $bus->kapasitas);

        $bus->nama_bus = $nama_bus;
        $bus->plat_nomor = $plat_nomor;
        $bus->kapasitas = $kapasitas;

        $bus->save();

        $this->info("Data berhasil diperbaharui!!");
        return Command::SUCCESS;
    }
}
