<?php

namespace App\Console\Commands\Kelas;

use App\Models\Kelas;
use Illuminate\Console\Command;

class KelasListCommand extends Command
{
    protected $signature = 'kelas:list';
    protected $description = 'List all Kelas data';

    public function handle()
    {
        $kelas = Kelas::all();

        if (app()->runningInConsole()) {
            if ($kelas->isEmpty()) {
                echo "Kelas is not found";
            } else {
                // foreach ($kelas as $user) {
                //     echo "\n";
                //     echo "ID: " . $user->id_kelas . "\n";
                //     echo "Nama Kelas: " . $user->nama_kelas . "\n";
                //     echo "Created At: " . $user->created_at . "\n";
                //     echo "Updated At: " . $user->updated_at . "\n";
                //     echo "----------------------------------------\n";
                // }
                $this->table(
                    ['ID', 'Nama Kelas', 'created_at', 'updated_at'],
                    $kelas->toArray()
                );
            }
        }
    }
}
