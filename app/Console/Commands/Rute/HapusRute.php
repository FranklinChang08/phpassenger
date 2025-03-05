<?php

namespace App\Console\Commands\Rute;

use Illuminate\Console\Command;
use App\Models\Rute;

class HapusRute extends Command
{
    protected $signature = 'rute:hapus {id}';
    protected $description = 'Menghapus data rute menggunakan Id';
    public function handle()
    {
        $id = $this->argument('id');
        $rute = Rute::where('id_rute', $id)->firstOrFail();

        if ($rute) {
            $rute->delete();
            $this->info("rute dengan id $id berhasil dihapus");
        } else {

            $this->info("rute dengan id $id tidak ditemukan");
        }
    }
}
