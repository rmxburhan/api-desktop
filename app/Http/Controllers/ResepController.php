<?php

namespace App\Http\Controllers;

use App\Models\Resep;
use Illuminate\Http\Request;

class ResepController extends Controller
{
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
}
