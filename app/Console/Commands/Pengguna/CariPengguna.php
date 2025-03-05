<?php

namespace App\Console\Commands\Pengguna;

use Illuminate\Console\Command;
use App\Models\Pengguna;

class CariPengguna extends Command
{
    protected $signature = 'pengguna:cari {search}';
    protected $description = 'Command description';
    public function handle()
    {
        $search = $this->argument('search');

        $pengguna = Pengguna::where("nama", "LIKE", "%$search%")
            ->orWhere('email', 'LIKE', "%$search%")
            ->orWhere('id_pengguna', 'LIKE', "%$search%")
            ->get();

        if ($pengguna->isEmpty()) {
            $this->info("Tidak menemukan data pengguna yang mengandung '$search'.");
        } else {
            $this->info("Hasil Pencarian Data '$search'.");
            $this->table(
                ['ID', 'Nama', 'Email', 'Nomor Telepon', 'Role'],
                $pengguna->toArray()
            );
        }
    }
}
