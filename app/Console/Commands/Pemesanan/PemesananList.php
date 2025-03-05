<?php

namespace App\Console\Commands\Pemesanan;

use App\Models\Pemesanan;
use Illuminate\Console\Command;

class PemesananList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pemesanan:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $pemesanan = Pemesanan::all();

        if (app()->runningInConsole()) {
            if ($pemesanan->isEmpty()) {
                echo "jadwal is not found";
            } else {
                $this->table(
                    ['ID', 'ID_Pengguna', 'ID_Jadwal', 'tanggal_pemesanan', 'Status', 'created_at', 'updated_at'],
                    $pemesanan->toArray()
                );
            }
        }
    }
}
