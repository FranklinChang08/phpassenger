<?php

namespace App\Http\Controllers;

use App\Models\DetailPemesanan;
use App\Models\Pemesanan;
use App\Models\Pengguna;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class NavigationController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function home()
    {
        $transaction_notif = Transaction::where('status_pembayaran', '=', 'Pending')
            ->where('id_pengguna', '=', auth()->id())->get();
        return view('home', compact('transaction_notif'));
    }
    public function aboutus()
    {
        $transaction_notif = Transaction::where('status_pembayaran', '=', 'Pending')
            ->where('id_pengguna', '=', auth()->id())->get();
        return view('aboutus', compact('transaction_notif'));
    }
    public function profile(Request $request, $id)
    {
        $pemesanan = DB::table('pemesanan')
            ->join('pengguna', 'pemesanan.id_pengguna', '=', 'pengguna.id_pengguna')
            ->join('jadwal', 'pemesanan.id_jadwal', '=', 'jadwal.id_jadwal')
            ->join('plane_rute', 'jadwal.id_plane_rute', '=', 'plane_rute.id_plane_rute')
            ->join('rute', 'plane_rute.id_rute', '=', 'rute.id_rute')
            ->join('plane', 'plane_rute.id_plane', '=', 'plane.id_plane')
            ->where('pemesanan.id_pengguna', '=', $id)
            ->orderBy('pemesanan.created_at')
            ->get();

        $pemesanan_history = DB::table('pemesanan')
            ->join('pengguna', 'pemesanan.id_pengguna', '=', 'pengguna.id_pengguna')
            ->join('jadwal', 'pemesanan.id_jadwal', '=', 'jadwal.id_jadwal')
            ->join('plane_rute', 'jadwal.id_plane_rute', '=', 'plane_rute.id_plane_rute')
            ->join('rute', 'plane_rute.id_rute', '=', 'rute.id_rute')
            ->join('plane', 'plane_rute.id_plane', '=', 'plane.id_plane')
            ->where('pemesanan.id_pengguna', '=', $id)
            ->orderBy('pemesanan.created_at')
            ->get();

        $date = $request->input('date');
        $status_pembayaran = $request->input('status_pembayaran');

        $transactionQuery = Transaction::join('pemesanan', 'pemesanan.id_pemesanan', '=', 'transaction.id_pemesanan')
            ->join('pengguna', 'pemesanan.id_pengguna', '=', 'pengguna.id_pengguna')
            ->join('jadwal', 'pemesanan.id_jadwal', '=', 'jadwal.id_jadwal')
            ->join('plane_rute', 'jadwal.id_plane_rute', '=', 'plane_rute.id_plane_rute')
            ->join('rute', 'plane_rute.id_rute', '=', 'rute.id_rute')
            ->join('plane', 'plane_rute.id_plane', '=', 'plane.id_plane')
            ->with('pemesanan.detailPemesanan')
            ->where('pemesanan.id_pengguna', '=', $id);

        if ($date) {
            $transactionQuery->whereDate('tanggal_pembayaran', '=', $date);
        }

        if ($status_pembayaran) {
            $transactionQuery->where('status_pembayaran', '=', $status_pembayaran);
        }

        $transaksi = $transactionQuery->orderBy('transaction.created_at', 'desc')->get();
        $transaction_notif = Transaction::where('status_pembayaran', '=', 'Pending')
            ->where('id_pengguna', '=', auth()->id())->get();


        $detailpemesanan = DetailPemesanan::join('pemesanan', 'pemesanan.id_pemesanan', '=', 'detail_pemesanan.id_pemesanan')
            ->where('pemesanan.id_pengguna', '=', auth()->id())
            ->get();

        return view('profile', compact('pemesanan', 'detailpemesanan', 'transaksi', 'pemesanan_history', 'transaction_notif'));
    }
    public function pemesananForm()
    {
        $transaction_notif = Transaction::where('status_pembayaran', '=', 'Pending')
            ->where('id_pengguna', '=', auth()->id())->get();
        return view('pemesanan', compact('transaction_notif'));
    }
    public function ticket(Request $request)
    {
        $asal = $request->input('asal');
        $tujuan = $request->input('tujuan');
        $date = $request->input('date');

        $kursiplane = DB::table('kursi_plane')
            ->join('plane', 'kursi_plane.id_plane', '=', 'plane.id_plane')
            ->join('kelas', 'kursi_plane.id_kelas', '=', 'kelas.id_kelas')
            ->where('kursi_plane.status', '=', 'Available')
            ->get();

        $availableplaneIds = $kursiplane->pluck('id_plane');

        $jadwalQuery = DB::table('jadwal')
            ->join('plane_rute', 'jadwal.id_plane_rute', '=', 'plane_rute.id_plane_rute')
            ->join('plane', 'plane_rute.id_plane', '=', 'plane.id_plane')
            ->join('rute', 'plane_rute.id_rute', '=', 'rute.id_rute')
            ->join('harga', 'harga.id_rute', '=', 'plane_rute.id_rute') // Correct join for 'harga'
            ->join('kelas', 'harga.id_kelas', '=', 'kelas.id_kelas') // Join 'kelas' using 'harga.id_kelas'
            ->whereIn('plane_rute.id_plane', $availableplaneIds)
            ->orderBy('jadwal.created_at');

        if ($asal) {
            $jadwalQuery->where('rute.asal', '=', $asal);
        }
        if ($tujuan) {
            $jadwalQuery->where('rute.tujuan', '=', $tujuan);
        }
        if ($date) {
            $jadwalQuery->where('jadwal.tanggal', '=', $date);
        }

        $jadwal = $jadwalQuery->get();

        $transaction_notif = Transaction::where('status_pembayaran', '=', 'Pending')
            ->where('id_pengguna', '=', auth()->id())->get();

        return view('ticket', compact('jadwal', 'transaction_notif'));
    }

    public function viewDetailPemesananCustomer($id_pengguna, $id_pemesanan)
    {
        $pengguna = Pengguna::findOrFail($id_pengguna);
        $pemesanan = DB::table('pemesanan')
            ->join('pengguna', 'pemesanan.id_pengguna', '=', 'pengguna.id_pengguna')
            ->join('jadwal', 'pemesanan.id_jadwal', '=', 'jadwal.id_jadwal')
            ->join('plane_rute', 'jadwal.id_plane_rute', '=', 'plane_rute.id_plane_rute')
            ->join('rute', 'plane_rute.id_rute', '=', 'rute.id_rute')
            ->join('plane', 'plane_rute.id_plane', '=', 'plane.id_plane')
            ->where('pemesanan.id_pengguna', '=', $id_pengguna)
            ->where('pemesanan.id_pemesanan', '=', $id_pemesanan)
            ->orderBy('pemesanan.created_at')
            ->first();

        $pemesanan_count = DB::table('pemesanan')
            ->join('pengguna', 'pemesanan.id_pengguna', '=', 'pengguna.id_pengguna')
            ->join('jadwal', 'pemesanan.id_jadwal', '=', 'jadwal.id_jadwal')
            ->join('plane_rute', 'jadwal.id_plane_rute', '=', 'plane_rute.id_plane_rute')
            ->join('rute', 'plane_rute.id_rute', '=', 'rute.id_rute')
            ->join('plane', 'plane_rute.id_plane', '=', 'plane.id_plane')
            ->where('pemesanan.id_pengguna', '=', $id_pengguna)
            ->orderBy('pemesanan.created_at')
            ->get();


        $transaksi = Transaction::join('pemesanan', 'pemesanan.id_pemesanan', '=', 'transaction.id_pemesanan')
            ->join('pengguna', 'pemesanan.id_pengguna', '=', 'pengguna.id_pengguna')
            ->join('jadwal', 'pemesanan.id_jadwal', '=', 'jadwal.id_jadwal')
            ->join('plane_rute', 'jadwal.id_plane_rute', '=', 'plane_rute.id_plane_rute')
            ->join('rute', 'plane_rute.id_rute', '=', 'rute.id_rute')
            ->join('plane', 'plane_rute.id_plane', '=', 'plane.id_plane')
            ->where('pemesanan.id_pengguna', '=', $id_pengguna)
            ->orderBy('pemesanan.created_at')
            ->get();

        foreach ($pemesanan as $item) {
            $detailpemesanan = DetailPemesanan::join('pemesanan', 'pemesanan.id_pemesanan', '=', 'detail_pemesanan.id_pemesanan')
                ->where('pemesanan.id_pengguna', '=', $pemesanan->id_pengguna)
                ->where('pemesanan.id_pemesanan', '=', $pemesanan->id_pemesanan)
                ->get();

            $detailpemesanan_count = DetailPemesanan::join('pemesanan', 'pemesanan.id_pemesanan', '=', 'detail_pemesanan.id_pemesanan')
                ->where('pemesanan.id_pengguna', '=', $pemesanan->id_pengguna)
                ->get();
        }

        $transaction_notif = Transaction::where('status_pembayaran', '=', 'Pending')
            ->where('id_pengguna', '=', auth()->id())->get();

        return view('detailpemesanancustomer', compact('pengguna', 'pemesanan', 'pemesanan_count', 'transaksi', 'detailpemesanan', 'detailpemesanan_count', 'transaction_notif'));
    }
}
