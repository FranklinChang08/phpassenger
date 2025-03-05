<?php

namespace App\Console\Commands\DetailPemesanan;

use App\Models\DetailPemesanan;
use Illuminate\Console\Command;

class DetailList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'detail:list';

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
        $detail = DetailPemesanan::all();

        if (app()->runningInConsole()) {
            if ($detail->isEmpty()) {
                echo "detail is not found";
            } else {
                $this->table(
                    ["ID", "ID Pemesanan", "ID Kursi Bus", "Nama Penumpang", "Nomor Identitas", "Harga Kursi", "Total Harga", "Created At", "Updated At"],
                    $detail->toArray()
                );
            }
        }
    }
}
