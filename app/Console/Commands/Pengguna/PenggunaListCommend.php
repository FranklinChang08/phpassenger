<?php

namespace App\Console\Commands\Pengguna;

use Illuminate\Console\Command;
use App\Models\Pengguna;

class PenggunaListCommend extends Command
{
    protected $signature = 'pengguna:list';
    protected $description = 'List all Pengguna data';

    public function handle()
    {
        $pengguna = Pengguna::all();

        if (app()->runningInConsole()) {
            if ($pengguna->isEmpty()) {
                echo "Pengguna is not found";
            } else {
                // foreach ($pengguna as $user) {
                //     echo "\n";
                //     echo "ID: " . $user->id_pengguna . "\n";
                //     echo "Nama: " . $user->nama . "\n";
                //     echo "Email: " . $user->email . "\n";
                //     echo "Nomor Telepon: " . $user->nomor_telepon . "\n";
                //     echo "Role: " . $user->role . "\n";
                //     echo "----------------------------------------\n";
                // }
                $this->table(
                    ['ID', 'Nama', 'Email', 'Nomor Telepon', 'Role', 'created_at', 'updated_at'],
                    $pengguna->toArray()
                );
            }
        }
    }
}
