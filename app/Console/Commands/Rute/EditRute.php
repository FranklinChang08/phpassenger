<?php

namespace App\Console\Commands\Rute;

use App\Models\Rute;
use Illuminate\Console\Command;

class EditRute extends Command
{
    protected $signature = 'rute:edit {id}';
    protected $description = 'Command description';
    public function handle()
    {
        $id = $this->argument('id');
        $rute = Rute::find($id);

        if (!$rute) {
            $this->error('rute tidak ditemukan');
            return Command::FAILURE;
        }

        $this->info('Data rute saat ini: ');
        $this->info("Asal: {$rute->asal}");
        $this->info("Tujuan: {$rute->tujuan}");
        $this->info("Jarak Km: {$rute->jarak_km}");

        $asal = $this->ask('Asal baru (kosongkan untuk tetap sama)', $rute->asal);
        $tujuan = $this->ask('Tujuan baru (kosongkan untuk tetap sama)', $rute->tujuan);
        $jarak_km = $this->ask('Jarak Km baru (kosongkan untuk tetap sama)', $rute->jarak_km);

        $rute->asal = $asal;
        $rute->tujuan = $tujuan;
        $rute->jarak_km = $jarak_km;

        $rute->save();

        $this->info("Data berhasil diperbaharui!!");
        return Command::SUCCESS;
    }
}
