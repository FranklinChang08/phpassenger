<?php

namespace App\Console\Commands\Kelas;

use App\Models\Kelas;
use Illuminate\Console\Command;

class CariKelas extends Command
{
    protected $signature = 'kelas:cari {search}';
    protected $description = 'Command description';
    public function handle()
    {
        $search = $this->argument('search');

        $kelas = Kelas::where("nama_kelas", "LIKE", "%$search%")
            ->orWhere('id_kelas', 'LIKE', "%$search%")
            ->get();

        if ($kelas->isEmpty()) {
            $this->info("Tidak menemukan data kelas yang mengandung '$search'.");
        } else {
            $this->info("Hasil Pencarian Data '$search'.");
            $this->table(
                ['ID', 'Nama', 'Email', 'Nomor Telepon', 'Role'],
                $kelas->toArray()
            );
        }
    }
}
