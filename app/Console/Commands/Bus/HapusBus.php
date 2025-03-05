<?php

namespace App\Console\Commands;

use App\Models\Bus;
use Illuminate\Console\Command;

class HapusBus extends Command
{

    protected $signature = 'bus:hapus {id}';
    protected $description = 'menghapus data bus dengan menggunakan ID';

    public function handle()
    {
        $id = $this->argument('id');
        $bus = Bus::findOrFail($id);

        if ($bus) {
            $bus->delete();
            $this->info("bus dengan id $id berhasil dihapus");
        } else {

            $this->info("bus dengan id $id tidak ditemukan");
        }
    }
}
