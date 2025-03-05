<?php

namespace App\Console\Commands\Jadwal;

use App\Models\Jadwal;
use Illuminate\Console\Command;

class HapusJadwal extends Command
{
    protected $signature = 'jadwal:hapus {id}';
    protected $description = 'Menghapus data jadwal berdasarkan id';

    public function handle()
    {
        $id = $this->argument('id');
        $jadwal = Jadwal::find($id);

        if ($jadwal) {
            $jadwal->delete();
            $this->info("Jadwal dengan ID $id berhasil dihapus.");
        } else {
            $this->error("Jadwal dengan ID $id tidak ditemukan");
        }
    }
}
