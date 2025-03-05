<?php

namespace App\Http\Controllers;

use App\Models\planeRute;
use App\Models\DetailPemesanan;
use App\Models\Harga;
use App\Models\Jadwal;
use App\Models\KursiPlane;
use App\Models\Pemesanan;
use App\Models\Pengguna;
use DB;
use Exception;
use Illuminate\Http\Request;

class PemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $penggunaId = $request->input('pengguna');

        $pengguna = Pengguna::all();

        $pemesananQuery = DB::table('pemesanan')
            ->join('pengguna', 'pemesanan.id_pengguna', '=', 'pengguna.id_pengguna')
            ->join('jadwal', 'pemesanan.id_jadwal', '=', 'jadwal.id_jadwal')
            ->join('plane_rute', 'jadwal.id_plane_rute', '=', 'plane_rute.id_plane_rute')
            ->join('rute', 'plane_rute.id_rute', '=', 'rute.id_rute')
            ->join('plane', 'plane_rute.id_plane', '=', 'plane.id_plane')
            ->orderBy('pemesanan.created_at');

        if ($penggunaId) {
            $pemesananQuery->where('pemesanan.id_pengguna', $penggunaId);
        }

        $pemesanan = $pemesananQuery->paginate(15);

        return view('admin.pemesanan.index', compact('pemesanan', 'pengguna', 'penggunaId'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pengguna = Pengguna::all();

        $kursiplane = DB::table('kursi_plane')
            ->join('plane', 'kursi_plane.id_plane', '=', 'plane.id_plane')
            ->join('kelas', 'kursi_plane.id_kelas', '=', 'kelas.id_kelas')
            ->where('kursi_plane.status', '=', 'Available')
            ->get();

        $availableplaneIds = $kursiplane->pluck('id_plane');

        $jadwal = DB::table('jadwal')
            ->join('plane_rute', 'jadwal.id_plane_rute', '=', 'plane_rute.id_plane_rute')
            ->join('plane', 'plane_rute.id_plane', '=', 'plane.id_plane')
            ->join('rute', 'plane_rute.id_rute', '=', 'rute.id_rute')
            ->join('harga', 'harga.id_rute', '=', 'plane_rute.id_rute') // Correct join for 'harga'
            ->join('kelas', 'harga.id_kelas', '=', 'kelas.id_kelas') // Join 'kelas' using 'harga.id_kelas'
            ->whereIn('plane_rute.id_plane', $availableplaneIds)
            ->get();


        return view("admin.pemesanan.create", compact('pengguna', 'jadwal', 'kursiplane'));
    }

    public function store(Request $request)
    {
        try {
            // Step 1: Validate and extract id_jadwal
            if (!str_contains($request->id_jadwal, ',')) {
                throw new Exception('Invalid id_jadwal format.');
            }
            [$id_jadwal, $id_kelas, $tanggal] = explode(',', $request->id_jadwal);


            $pemesanan = Pemesanan::create([
                'id_pengguna' => $request->id_pengguna,
                'id_jadwal' => $id_jadwal,
            ]);

            if (!$pemesanan) {
                throw new Exception('Pemesanan gagal dibuat.');
            }
            $id_pemesanan = $pemesanan->id_pemesanan; // Retrieve ID
            $id_pengguna = $pemesanan->id_pengguna; // Retrieve ID

            // Step 2: Find pengguna
            $pengguna = Pengguna::findOrFail($request->id_pengguna);

            // Step 3: Retrieve jadwal with error handling
            $jadwal = DB::table('jadwal')
                ->join('plane_rute', 'jadwal.id_plane_rute', '=', 'plane_rute.id_plane_rute')
                ->join('plane', 'plane_rute.id_plane', '=', 'plane.id_plane')
                ->join('rute', 'plane_rute.id_rute', '=', 'rute.id_rute')
                ->join('harga', 'harga.id_rute', '=', 'plane_rute.id_rute') // Keep only one join for 'harga'
                ->join('kelas', 'harga.id_kelas', '=', 'kelas.id_kelas')
                ->where('id_jadwal', '=', $id_jadwal)
                ->where('harga.id_kelas', '=', $id_kelas)
                ->where('jadwal.tanggal', '=', $tanggal)
                ->first();

            // Step 4: Retrieve available kursiplane
            $kursiplane = DB::table('kursi_plane')
                ->join('kelas', 'kursi_plane.id_kelas', '=', 'kelas.id_kelas')
                ->where('id_plane', '=', $jadwal->id_plane)
                ->where('kelas.nama_kelas', '=', $jadwal->nama_kelas)
                ->where('status', '=', 'Available')
                ->get();

            return view('admin.pemesanan.detailcreate', compact('pengguna', 'kursiplane', 'jadwal', 'id_pemesanan', 'id_pengguna'));
        } catch (Exception $e) {
            return redirect()->route('pemesanan.index')->with('error', 'Pemesanan gagal dibuat: ' . $e->getMessage());
        }
    }



    public function show(string $id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $detail_pemesanan = DB::table('detail_pemesanan')
            ->join('kursi_plane', 'detail_pemesanan.id_kursi_plane', '=', 'kursi_plane.id_kursi_plane')
            ->where('id_pemesanan', '=', $id)
            ->first();

        $pengguna = Pengguna::all();

        $jadwal = DB::table('jadwal')
            ->join('plane_rute', 'jadwal.id_plane_rute', '=', 'plane_rute.id_plane_rute')
            ->join('plane', 'plane_rute.id_plane', '=', 'plane.id_plane')
            ->join('rute', 'plane_rute.id_rute', '=', 'rute.id_rute')

            ->get();

        $kursiplane = DB::table('kursi_plane')
            ->join('plane', 'kursi_plane.id_plane', '=', 'plane.id_plane')
            ->join('kelas', 'kursi_plane.id_kelas', '=', 'kelas.id_kelas')
            ->get();

        return view("admin.pemesanan.edit", compact('pengguna', 'jadwal', 'kursiplane', 'pemesanan', 'detail_pemesanan'));
    }

    public function update(Request $request, string $id)
    {

    }
    public function destroy(string $id)
    {
        try {
            $pemesanan = Pemesanan::findOrFail($id);

            $details = DB::table('detail_pemesanan')->where('id_pemesanan', '=', $id)->get();
            if (!$details->isEmpty()) {
                foreach ($details as $detail) {
                    $kursiplane = KursiPlane::find($detail->id_kursi_plane);
                    if ($kursiplane) {
                        $kursiplane->status = 'Available';
                        $kursiplane->save();
                    }

                    DB::table('detail_pemesanan')->where('id_detail_pemesanan', $detail->id_detail_pemesanan)->delete();
                }
            }

            $pemesanan->delete();

            return redirect()->route('pemesanan.index')->with('success', 'Data Pemesanan berhasil Dihapus.');
        } catch (Exception $e) {
            return redirect()->route('pemesanan.index')->with('error', 'Data Pemesanan Gagal Dihapus: ' . $e->getMessage());
        }
    }

    public function detail($id, Request $request)
    {
        $nama = $request->input('nama_penumpang');
        $nomorIdentitas = $request->input('nomor_identitas');
        $detailpemesananQuery = DB::table('detail_pemesanan')
            ->join('pemesanan', 'detail_pemesanan.id_pemesanan', '=', 'pemesanan.id_pemesanan')
            ->join('kursi_plane', 'detail_pemesanan.id_kursi_plane', '=', 'kursi_plane.id_kursi_plane')
            ->join('kelas', 'kursi_plane.id_kelas', '=', 'kelas.id_kelas')
            ->where('detail_pemesanan.id_pemesanan', '=', $id);

        $pemesanan = DB::table('pemesanan')
            ->join('pengguna', 'pemesanan.id_pengguna', '=', 'pengguna.id_pengguna')
            ->join('jadwal', 'pemesanan.id_jadwal', '=', 'jadwal.id_jadwal')
            ->join('plane_rute', 'jadwal.id_plane_rute', '=', 'plane_rute.id_plane_rute')
            ->join('rute', 'plane_rute.id_rute', '=', 'rute.id_rute')
            ->join('plane', 'plane.id_plane', '=', 'plane.id_plane')
            ->where('pemesanan.id_pemesanan', '=', $id)
            ->first();

        if ($nama) {
            $detailpemesananQuery->where('detail_pemesanan.nama_penumpang', 'LIKE', "%$nama%");
        }
        if ($nomorIdentitas) {
            $detailpemesananQuery->where('detail_pemesanan.nomor_identitas', 'LIKE', "%$nomorIdentitas%");
        }
        $detailpemesanan = $detailpemesananQuery->get();
        return view("admin.pemesanan.detail", compact('detailpemesanan', 'pemesanan'));
    }

    public function storedetail(Request $request)
    {
        try {
            $request->validate([
                'pemesanan.*.id_pemesanan' => 'required|numeric',
                'pemesanan.*.nama_penumpang' => 'required|string',
                'pemesanan.*.id_kursi_plane' => 'required|numeric',
                'pemesanan.*.nomor_identitas' => 'required|string',
                'pemesanan.*.harga_kursi' => 'required|numeric|min:0',
                'total_harga' => 'required|numeric|min:0',
                'id_pengguna' => 'required|numeric',
            ]);

            $total_harga = $request->total_harga;

            foreach ($request->pemesanan as $data) {
                $detailpemesanan = DetailPemesanan::create([
                    'id_pemesanan' => $data['id_pemesanan'],
                    'nama_penumpang' => $data['nama_penumpang'],
                    'id_kursi_plane' => $data['id_kursi_plane'],
                    'nomor_identitas' => $data['nomor_identitas'],
                    'harga_kursi' => $data['harga_kursi'],
                    'total_harga' => $total_harga,
                ]);

                if (!$detailpemesanan) {
                    throw new Exception('Detail pemesanan gagal dibuat.');
                }
            }


            return redirect()->route('transaction.create', ['id_pemesanan' => $detailpemesanan->id_pemesanan, 'id_pengguna' => $request->id_pengguna])->with('success', 'Detail Pemesanan berhasil dibuat.');
        } catch (Exception $e) {
            return redirect()->route('pemesanan.index')->with('error', 'Gagal membuat detail pemesanan: ' . $e->getMessage());
        }
    }

    public function cancel($id)
    {
        try {

            $pemesanan = Pemesanan::findOrFail($id);
            $details = DetailPemesanan::where('id_pemesanan', $id)->get();

            foreach ($details as $detail) {
                $kursiplane = KursiPlane::findOrFail($detail->id_kursi_plane);
                $kursiplane->status = 'Available';
                $kursiplane->save();
            }

            DetailPemesanan::where('id_pemesanan', $id)->delete();
            $pemesanan->delete();

            return redirect()->route('pemesanan.index')->with('success', 'Pemesanan berhasil dibatalkan.');
        } catch (Exception $e) {
            return redirect()->route('pemesanan.index')->with('error', 'Pemesanan gagal dibatalkan: ' . $e->getMessage());
        }
    }

    public function confirm($id)
    {
        try {
            $pemesanan = Pemesanan::findOrFail($id);
            if ($pemesanan) {
                $pemesanan->status = 'Confirmed';
                $pemesanan->save();
            }
            $detail = DetailPemesanan::where('id_pemesanan', '=', $id)->get();

            foreach ($detail as $item) {
                $kursiplane = KursiPlane::find($item->id_kursi_plane);

                if ($kursiplane) {
                    $kursiplane->status = 'Available';
                    $kursiplane->save();
                }
            }
            return redirect()->route('pemesanan.index')->with('success', 'Pemesanan berhasil dikonfirmasi.');
        } catch (Exception $e) {
            return redirect()->route('pemesanan.index')->with('error', 'Pemesanan gagal dikonfirmasi: ' . $e->getMessage());
        }
    }

    public function destroydetail(Request $request, $id)
    {
        try {
            $detail = DetailPemesanan::findOrFail($id);

            $kursiplane = KursiPlane::find($detail->id_kursi_plane);

            if ($kursiplane) {
                $kursiplane->status = 'Available';
                $kursiplane->save();
            }

            $updateTotalHarga = DetailPemesanan::where('id_pemesanan', $request->id_pemesanan)
                ->where('id_detail_pemesanan', '!=', $id)
                ->get();

            foreach ($updateTotalHarga as $item) {
                $item->total_harga -= $detail->harga_kursi;
                $item->save();
            }

            $detail->delete();

            return redirect()->route('detailpemesanan.list', $detail->id_pemesanan)->with('success', 'Data Pemesanan berhasil Dihapus.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Pemesanan gagal dihapus: ' . $e->getMessage());
        }
    }

    public function editdetailform($id)
    {
        $detailpemesanan = DB::table('detail_pemesanan')
            ->join('pemesanan', 'detail_pemesanan.id_pemesanan', '=', 'pemesanan.id_pemesanan')
            ->join('kursi_plane', 'detail_pemesanan.id_kursi_plane', '=', 'kursi_plane.id_kursi_plane')
            ->join('kelas', 'kursi_plane.id_kelas', '=', 'kelas.id_kelas')
            ->where('detail_pemesanan.id_detail_pemesanan', '=', $id)
            ->first();
        $kursiplane = DB::table('kursi_plane')
            ->join('plane', 'kursi_plane.id_plane', '=', 'plane.id_plane')
            ->join('kelas', 'kursi_plane.id_kelas', '=', 'kelas.id_kelas')
            ->where('kursi_plane.status', '=', 'Available')
            ->where('kelas.nama_kelas', '=', $detailpemesanan->nama_kelas)
            ->get();
        return view('admin.pemesanan.detailedit', compact('detailpemesanan', 'kursiplane'));
    }

    public function updatedetail(Request $request, $id)
    {
        $detailpemesanan = DetailPemesanan::findOrFail($id);

        $validateData = $request->validate([
            'nama_penumpang' => 'required|string',
            'id_kursi_plane' => 'required|numeric',
            'nomor_identitas' => 'required|string',
        ]);

        if ($detailpemesanan->id_kursi_plane != $validateData['id_kursi_plane']) {
            $kursiplane = KursiPlane::find($detailpemesanan->id_kursi_plane);
            $kursiplane->status = 'Available';
            $kursiplane->save();
        }

        $updateKursi = KursiPlane::find($validateData['id_kursi_plane']);
        $updateKursi->status = 'Booked';
        $updateKursi->save();

        $detailpemesanan->nama_penumpang = $validateData['nama_penumpang'];
        $detailpemesanan->id_kursi_plane = $validateData['id_kursi_plane'];
        $detailpemesanan->nomor_identitas = $validateData['nomor_identitas'];
        $detailpemesanan->save();

        return redirect()->route('detailpemesanan.list', $detailpemesanan->id_pemesanan)->with('success', 'Data detail pemesanan sudah diupdate');
    }

    public function addnew($id_pemesanan, $id_kelas, $tanggal)
    {
        $pemesanan = Pemesanan::findOrFail($id_pemesanan);

        // Step 3: Retrieve jadwal with error handling
        $jadwal = DB::table('jadwal')
            ->join('plane_rute', 'jadwal.id_plane_rute', '=', 'plane_rute.id_plane_rute')
            ->join('plane', 'plane_rute.id_plane', '=', 'plane.id_plane')
            ->join('rute', 'plane_rute.id_rute', '=', 'rute.id_rute')
            ->join('harga', 'harga.id_rute', '=', 'plane_rute.id_rute') // Keep only one join for 'harga'
            ->join('kelas', 'harga.id_kelas', '=', 'kelas.id_kelas')
            ->where('id_jadwal', '=', $pemesanan->id_jadwal)
            ->where('harga.id_kelas', '=', $id_kelas)
            ->where('jadwal.tanggal', '=', $tanggal)
            ->first();

        // Step 4: Retrieve available kursiplane
        $kursiplane = DB::table('kursi_plane')
            ->join('kelas', 'kursi_plane.id_kelas', '=', 'kelas.id_kelas')
            ->where('id_plane', '=', $jadwal->id_plane)
            ->where('kelas.nama_kelas', '=', $jadwal->nama_kelas)
            ->where('status', '=', 'Available')
            ->get();

        return view('admin.pemesanan.detailcreatenew', compact('jadwal', 'kursiplane', 'id_pemesanan'));
    }

    public function storedetailnew(Request $request)
    {
        try {
            $request->validate([
                'id_pemesanan' => 'required|numeric',
                'pemesanan.*.id_pemesanan' => 'required|numeric',
                'pemesanan.*.nama_penumpang' => 'required|string',
                'pemesanan.*.id_kursi_plane' => 'required|numeric',
                'pemesanan.*.nomor_identitas' => 'required|string',
                'pemesanan.*.harga_kursi' => 'required|numeric|min:0',
            ]);

            $idPemesanan = $request->id_pemesanan;

            foreach ($request->pemesanan as $data) {
                $detailpemesanan = DetailPemesanan::create([
                    'id_pemesanan' => $data['id_pemesanan'],
                    'nama_penumpang' => $data['nama_penumpang'],
                    'id_kursi_plane' => $data['id_kursi_plane'],
                    'nomor_identitas' => $data['nomor_identitas'],
                    'harga_kursi' => $data['harga_kursi'],
                ]);

                if (!$detailpemesanan) {
                    return redirect()->route('pemesanan.index')->with('error', 'Gagal menambahkan salah satu detail pemesanan.');
                }

                $kursiplane = KursiPlane::find($data['id_kursi_plane']);
                if ($kursiplane) {
                    $kursiplane->status = 'Booked';
                    $kursiplane->save();
                }
            }

            $totalHargaBaru = DetailPemesanan::where('id_pemesanan', $idPemesanan)
                ->sum('harga_kursi');

            $detailPemesananUpdate = DetailPemesanan::where('id_pemesanan', $idPemesanan)->get();
            foreach ($detailPemesananUpdate as $item) {
                $item->total_harga = $totalHargaBaru;
                $item->save();
            }

            return redirect()->route('detailpemesanan.list', $idPemesanan)->with('success', 'Detail Pemesanan berhasil dibuat.');
        } catch (Exception $e) {
            return redirect()->route('detailpemesanan.list', $idPemesanan)->with('error', 'Gagal membuat detail pemesanan: ' . $e->getMessage());
        }
    }
}
