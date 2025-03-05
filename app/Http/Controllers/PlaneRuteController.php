<?php

namespace App\Http\Controllers;

use App\Models\Plane;
use App\Models\PlaneRute;
use App\Models\Rute;
use DB;
use Illuminate\Http\Request;

class PlaneRuteController extends Controller
{
    public function index(Request $request)
    {
        $planeID = $request->input('id_plane');
        $ruteID = $request->input('id_rute');

        $planeruteQuery = DB::table('plane_rute')
            ->join('rute', 'plane_rute.id_rute', '=', 'rute.id_rute')
            ->join('plane', 'plane_rute.id_plane', '=', 'plane.id_plane');

        if ($planeID) {
            $planeruteQuery->where('plane.id_plane', $planeID);
        }
        if ($ruteID) {
            $planeruteQuery->OrWhere('rute.id_rute', $ruteID);
        }

        $planerute = $planeruteQuery->get();

        $plane = Plane::all();
        $rute = Rute::all();
        return view('admin.planerute.index', compact('planerute', 'rute', 'plane'));
    }


    // public function create()
    // {
    //     //
    // }


    public function store(Request $request)
    {
        $validateData = $request->validate([
            'id_rute' => 'required|numeric',
            'id_plane' => 'required|numeric',
        ]);


        $checkData = PlaneRute::where('id_plane', $validateData['id_plane'])
            ->where('id_rute', $validateData['id_rute'])
            ->exists();
        if ($checkData) {
            return redirect()->route('planerute.index')->with('error', 'Data bus rute sudah ada');
        } else {
            PlaneRute::create($validateData);
        }
        return redirect()->route('planerute.index')->with('success', 'Data bus rute berhasil dimasukkan');
    }

    public function show(string $id)
    {
        $planerute = PlaneRute::findOrFail($id);

        $plane = Plane::all();
        $rute = Rute::all();

        return view('admin.planerute.edit', compact('planerute', 'rute', 'plane'));
    }

    public function update(Request $request, string $id)
    {
        try {
            $planerute = PlaneRute::findOrFail($id);
            $validateData = $request->validate([
                'id_rute' => 'required|numeric',
                'id_plane' => 'required|numeric',
            ]);

            $checkData = PlaneRute::where('id_rute', $validateData['id_rute'])
                ->where('id_plane', $validateData['id_plane'])
                ->where('id_plane_rute', '!=', $id)
                ->exists();

            if ($checkData) {
                return redirect()->route('planerute.index')->with('error', 'Data bus rute sudah ada');
            } else {
                $planerute->id_rute = $validateData['id_rute'];
                $planerute->id_plane = $validateData['id_plane'];

                $planerute->save();
            }
            return redirect()->route('planerute.index')->with('success', 'Data bus rute berhasil diupdate');
        } catch (\Exception $e) {
            return redirect()->route('planerute.index')->with('error', 'Gagal menghapus data bus rute. Silakan coba lagi.');
        }
    }

    public function destroy(string $id)
    {
        try {
            $planerute = PlaneRute::findOrFail($id);

            $planerute->delete();

            return redirect()->route('planerute.index')->with('success', 'Data bus rute berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('planerute.index')->with('error', 'Gagal menghapus data bus rute. Silakan coba lagi.');
        }
    }
}
