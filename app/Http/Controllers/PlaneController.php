<?php

namespace App\Http\Controllers;

use App\Models\Plane;
use App\Models\Kelas;
use Exception;
use Illuminate\Http\Request;

class PlaneController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search');
        if ($search) {
            $plane = Plane::with('plane_kelas')->where('nama_maskapai', 'LIKE', "%$search%")
                ->orWhere('plat_nomor', 'LIKE', "%$search%")
                ->get();
        } else {
            $plane = Plane::with('plane_kelas')->get();
        }
        return view('admin.plane.index', compact('plane'));
    }

    public function create()
    {
        $kelas = Kelas::all();
        return view('admin.Plane.create', compact('kelas'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama_maskapai' => 'required|string|max:100',
            'nomor_regis' => 'required|string|max:10|unique:Plane',
            'nomor_penerbangan' => 'required|string|max:10|unique:Plane',
            'kapasitas' => 'required|numeric',
            'kelas' => 'required|array'
        ]);

        $createPlane = Plane::create([
            'nama_maskapai' => $request->nama_maskapai,
            'nomor_regis' => $request->nomor_regis,
            'nomor_penerbangan' => $request->nomor_penerbangan,
            'kapasitas' => $request->kapasitas,
        ]);
        $createPlane->plane_kelas()->sync($request->kelas);
        return redirect()->route('plane.index')->with('success', 'Data Plane berhasil ditambahkan');
    }

    public function show($id)
    {
        $plane = Plane::findOrFail($id);
        $kelas = Kelas::all();
        return view('admin.Plane.edit', compact('kelas', 'plane'));
    }

    public function update(Request $request, $id)
    {
        $plane = Plane::findOrFail($id);
        $validateData = $request->validate([
            'nama_maskapai' => 'required|string|max:100',
            'nomor_regis' => 'required|string|max:10',
            'nomor_penerbangan' => 'required|string|max:10',
            'kapasitas' => 'required|numeric',
            'kelas' => 'required|array'
        ]);

        $checkPlane = Plane::where('nomor_regis', '=', $request->nomor_regis)
            ->where('id_plane', '!=', $id)->first();
        if ($checkPlane) {
            return redirect()->back()->with('error', 'the plat nomor has been taken');
        }

        $plane->nama_maskapai = $validateData['nama_maskapai'];
        $plane->nomor_regis = $validateData['nomor_regis'];
        $plane->nomor_penerbangan = $validateData['nomor_penerbangan'];
        $plane->kapasitas = $validateData['kapasitas'];

        $plane->save();
        $plane->Plane_kelas()->sync($request->kelas);

        return redirect()->route('plane.index')->with('success', 'Data Plane berhasil diperbaharui');
    }

    public function destroy($id)
    {
        $plane = Plane::findOrFail($id);
        $plane->delete();

        return redirect()->route('plane.index')->with('success', 'Data Plane berhasil dihapus');
    }
}
