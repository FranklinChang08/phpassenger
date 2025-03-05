<?php

namespace App\Http\Controllers;

use App\Models\Plane;
use App\Models\PlaneRute;
use App\Models\Jadwal;
use App\Models\Rute;
use DB;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $planeId = $request->input('id_plane');
        $ruteId = $request->input('id_rute');
        $planeRuteId = $request->input('id_plane_rute');

        $plane = Plane::all();
        $rute = Rute::all();
        $planerute = DB::table('plane_rute')
            ->join('rute', 'plane_rute.id_rute', '=', 'rute.id_rute')
            ->join('plane', 'plane_rute.id_plane', '=', 'plane.id_plane')
            ->get();

        $jadwalQuery = DB::table('jadwal')
            ->join('plane_rute', 'jadwal.id_plane_rute', '=', 'plane_rute.id_plane_rute')
            ->join('plane', 'plane_rute.id_plane', '=', 'plane.id_plane')
            ->join('rute', 'plane_rute.id_rute', '=', 'rute.id_rute')
            ->orderBy('jadwal.created_at');

        if ($planeId) {
            $jadwalQuery->where('plane.id_plane', '=', $planeId);
        }
        if ($ruteId) {
            $jadwalQuery->orWhere('rute.id_rute', '=', $ruteId);
        }
        if ($planeRuteId) {
            $jadwalQuery->orWhere('plane_rute.id_plane_rute', $planeRuteId);
        }

        $jadwal = $jadwalQuery->get();
        return view('admin.jadwal.index', compact('jadwal', 'plane', 'rute', 'planerute'));
    }
    public function create()
    {
        $planerute = DB::table('plane_rute')
            ->join('rute', 'plane_rute.id_rute', '=', 'rute.id_rute')
            ->join('plane', 'plane_rute.id_plane', '=', 'plane.id_plane')
            ->get();
        return view('admin.jadwal.create', compact('planerute'));
    }
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'id_plane_rute' => 'required|numeric',
            'tanggal' => 'required|date|after_or_equal:today',
            'waktu_berangkat' => 'required',
            'waktu_tiba' => 'required|after:waktu_berangkat',
        ]);

        $existingJadwal = Jadwal::where('tanggal', $validateData['tanggal'])
            ->where('id_plane_rute', $validateData['id_plane_rute'])
            ->latest('created_at')
            ->first();

        if ($existingJadwal) {
            $berangkatExisting = Carbon::parse($existingJadwal->waktu_berangkat);
            $tibaExisting = Carbon::parse($existingJadwal->waktu_tiba);
            $newBerangkat = Carbon::parse($validateData['waktu_berangkat']);

            $minAllowedBerangkat = $tibaExisting->addHours($berangkatExisting->diffInHours($tibaExisting))->addMinutes(20);

            if ($newBerangkat->lt($minAllowedBerangkat)) {
                return redirect()->route('jadwal.index')->with('error', 'Data jadwal tidak sesuai atau tidak teratur dan harus lebih dari 20 menit dari waktu berangkat');
            }
        }

        $createJadwal = Jadwal::create($validateData);

        if ($createJadwal) {
            return redirect()->route('jadwal.index')->with('success', 'Data jadwal berhasil dimasukkan');
        }

        return redirect()->route('jadwal.index')->with('error', 'Data jadwal tidak berhasil dimasukkan');

    }

    public function show($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $planerute = DB::table('plane_rute')
            ->join('rute', 'plane_rute.id_rute', '=', 'rute.id_rute')
            ->join('plane', 'plane_rute.id_plane', '=', 'plane.id_plane')
            ->get();
        return view('admin.jadwal.edit', compact('planerute', 'jadwal'));
    }
    public function update(Request $request, $id)
    {
        $jadwal = Jadwal::findOrFail($id);

        $validateData = $request->validate([
            'id_plane_rute' => 'required|numeric',
            'tanggal' => 'required|date|after_or_equal:today',
            'waktu_berangkat' => 'required',
            'waktu_tiba' => 'required|after:waktu_berangkat',
        ]);
        $existingJadwal = Jadwal::where('tanggal', $validateData['tanggal'])
            ->where('id_plane_rute', $validateData['id_plane_rute'])
            ->where('id_jadwal', '!=', $id)
            ->latest('created_at')
            ->first();

        if ($existingJadwal) {
            $berangkatExisting = Carbon::parse($existingJadwal->waktu_berangkat);
            $tibaExisting = Carbon::parse($existingJadwal->waktu_tiba);
            $newBerangkat = Carbon::parse($validateData['waktu_berangkat']);

            $minAllowedBerangkat = $tibaExisting->addHours($berangkatExisting->diffInHours($tibaExisting))->addMinutes(20);

            if ($newBerangkat->lt($minAllowedBerangkat)) {
                return redirect()->route('jadwal.index')->with('error', 'Data jadwal tidak sesuai atau tidak teratur dan harus lebih dari 20 menit dari waktu berangkat');
            }
        }

        $jadwal->id_plane_rute = $validateData['id_plane_rute'];
        $jadwal->tanggal = $validateData['tanggal'];
        $jadwal->waktu_berangkat = $validateData['waktu_berangkat'];
        $jadwal->waktu_tiba = $validateData['waktu_tiba'];

        $jadwal->save();

        return redirect()->route('jadwal.index')->with('success', 'Data jadwal berhasil diupdate');
    }
    public function destroy($id)
    {
        try {
            $jadwal = Jadwal::findOrFail($id);
            $jadwal->delete();
            return redirect()->route('jadwal.index')->with('success', 'Data jadwal berhasil dihapus');
        } catch (Exception $e) {
            return redirect()->route('jadwal.index')->with('error', 'Data jadwal tidak berhasil dihapus');
        }
    }
}
