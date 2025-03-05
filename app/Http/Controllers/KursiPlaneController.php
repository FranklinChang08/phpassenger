<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\KursiPlane;
use App\Models\Plane;
use DB;
use Illuminate\Http\Request;

class KursiPlaneController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search');
        if ($search) {
            $kursiplane = DB::table('kursi_plane')
                ->join('plane', 'kursi_plane.id_plane', '=', 'plane.id_plane')
                ->join('kelas', 'kursi_plane.id_kelas', '=', 'kelas.id_kelas')
                ->where('nomor_kursi', 'LIKE', "%$search%")
                ->orWhere('status', 'LIKE', "%$search%")
                ->orWhere('plane.nama_plane', 'LIKE', "%$search%")
                ->paginate(15);
        } else {
            $kursiplane = DB::table('kursi_plane')
                ->join('plane', 'kursi_plane.id_plane', '=', 'plane.id_plane')
                ->join('kelas', 'kursi_plane.id_kelas', '=', 'kelas.id_kelas')
                ->paginate(15);
        }
        return view('admin.kursiplane.index', compact('kursiplane'));
    }

    public function create()
    {
        $plane = Plane::all();
        $kelas = Kelas::all();
        return view('admin.kursiplane.create', compact('plane', 'kelas'));
    }

    public function store(Request $request)
    {
        try {
            $validateData = $request->validate([
                'id_plane' => 'required|numeric',
                'id_kelas' => 'required|numeric',
                'nama_kursi' => 'required|string',
                'total_kursi' => 'required|numeric',
            ]);
            $kursiplane = DB::table('kursi_plane')
                ->join('plane', 'kursi_plane.id_plane', '=', 'plane.id_plane')
                ->join('kelas', 'kursi_plane.id_kelas', '=', 'kelas.id_kelas')
                ->where('kursi_plane.id_plane', '=', $request->id_plane)
                ->get();

            $plane = Plane::findOrFail($request->id_plane);

            $kursiplane_sameClass = KursiPlane::where('id_plane', $request->id_plane)
                ->where('id_kelas', $request->id_kelas)
                ->get();

            $existingCount = $kursiplane_sameClass->count();

            $startFrom = $existingCount > 0 ? $existingCount + 1 : 1;

            foreach (range($startFrom, $startFrom + $request->total_kursi - 1) as $nomor_kursi) {
                $dataInsertedKursi = $kursiplane->count() + $request->total_kursi;

                if ($dataInsertedKursi > $plane->kapasitas) {
                    return redirect()->route('kursiplane.index')->with('error', 'Kursi yang dibuat melebihi kapasitas plane');
                }

                $data = [
                    'id_plane' => $validateData['id_plane'],
                    'id_kelas' => $validateData['id_kelas'],
                    'nomor_kursi' => $validateData['nama_kursi'] . $nomor_kursi,
                ];

                KursiPlane::create($data);
            }

            return redirect()->route('kursiplane.index')->with('success', 'Data Kursi plane berhasil Dimasukkan');
        } catch (\Exception $e) {
            return redirect()->route('kursiplane.index')->with('error', 'Data Kursi plane gagal Dimasukkan' . $e->getMessage());
        }

    }

    public function show(string $id)
    {
        $kursiplane = KursiPlane::findOrFail($id);
        $plane = Plane::all();
        $kelas = Kelas::all();
        return view('admin.kursiplane.edit', compact('plane', 'kelas', 'kursiplane'));
    }

    public function update(Request $request, string $id)
    {
        try {
            $kursiplane = KursiPlane::findOrFail($id);
            $validateData = $request->validate([
                'id_plane' => 'required|numeric',
                'id_kelas' => 'required|numeric',
                'nomor_kursi' => 'required|string',
                'status' => 'required|in:Available,Booked',
            ]);

            $kursiplane->id_plane = $validateData['id_plane'];
            $kursiplane->id_kelas = $validateData['id_kelas'];
            $kursiplane->nomor_kursi = $validateData['nomor_kursi'];
            $kursiplane->status = $validateData['status'];

            $kursiplane->save();

            return redirect()->route('kursiplane.index')->with('success', 'Data Kursi plane berhasil Dimasukkan');
        } catch (\Exception $e) {
            return redirect()->route('kursiplane.index')->with('error', 'Data Kursi plane gagal Dimasukkan');
        }
    }
    public function destroy(string $id)
    {
        try {
            $kursiplane = KursiPlane::findOrFail($id);
            $kursiplane->delete();
            return redirect()->route('kursiplane.index')->with('success', 'Data Kursi plane berhasil Dihapus');
        } catch (\Exception $e) {
            return redirect()->route('kursiplane.index')->with('error', 'Data Kursi plane gagal Dihapus');
        }
    }
}
