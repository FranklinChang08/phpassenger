<?php

namespace App\Console\Commands\BusRute;

use App\Models\BusRute;
use Illuminate\Console\Command;

class HapusBusRute extends Command
{
    protected $signature = 'busrute:hapus {id}';
    protected $description = 'Menghapus data bus_rute berdasarkan id';

    public function handle()
    {
        $id = $this->argument('id');
        $busRute = BusRute::find($id);

        if ($busRute) {
            $busRute->delete();
            $this->info("Data bus_rute dengan ID $id berhasil dihapus.");
        } else {
            $this->error("Data tidak ditemukan");
        }
    }
}
