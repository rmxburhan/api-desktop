<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function index() {
        return response([
            'data' => Profil::all(),
        ]);
    }

    public function update(Request $request) 
    {
        $data = $request->validate([
            'latitude' => 'required',
            'longitude' => 'required',
            'nama_aplikasi' => 'required'
        ]);

        $profil = new Profil();

        $profil->id = 1;
        $profil->latitude = $request->latitude;
        $profil->longitude = $request->longitude;
        $profil->nama_aplikasi = $request->nama_aplikasi;
        $profil->update();


        return response([
            'status' => 'success',
            'data' => $profil
        ], 200);
    }
}
