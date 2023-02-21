<?php

namespace App\Http\Controllers;

use App\Models\Resep;
use Illuminate\Http\Request;

class ResepController extends Controller
{

    public function index()
    {
        $data = Resep::all();

        return response([
            'data' => $data,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'no_resep' => 'required',
            'tgl_resep' => 'required',
            'nama_pasien' => 'required',
            'nama_dokter' => 'required',
            'nama_obat' => 'required',
            'jumlah_obat' => 'required',
        ]);

        Resep::create($data);

        return response([
            'message' => 'success'
        ]);
    } 
    
    public function update(Request $request, Resep $resep)
    {
        $data = $request->validate([
            'no_resep' => 'required',
            'tgl_resep' => 'required',
            'nama_pasien' => 'required',
            'nama_dokter' => 'required',
            'nama_obat' => 'required',
            'jumlah_obat' => 'required'
        ]);

        $resep->update($data);

        return response([
            'message' => 'success'
        ]);
    }

    public function destroy(Resep $resep)
    {
        $resep->delete();

        return response([
            'message' => 'success'
        ]);
    }
}
