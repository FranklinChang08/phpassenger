<?php

namespace App\Console\Commands\Jadwal;

use App\Models\Jadwal;
use Illuminate\Console\Command;

class CariJadwal extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jadwal:cari {search}';
    protected $description = 'Mencari data jadwal berdasarkan ID dan ID Bus Rute';

    public function handle()
    {
        $search = $this->argument('search');
        $jadwal = Jadwal::where('id_jadwal', 'LIKE', "%$search%")
            ->orWhere('id_bus_rute', 'LIKE', "%$search%")
            ->get();

        if ($jadwal->isEmpty()) {
            $this->error("jadwal yang anda cari tidak ditemukan");
        } else {
            $this->info("Hasil pencarian jadwal untuk $search ");
            $this->table(["ID", "ID Bus Rute", "Tanggal", "Waktu_Berangkat","Waktu_Tiba", "Created At", "Updated At"], $jadwal->toArray());
        }
    }
}
