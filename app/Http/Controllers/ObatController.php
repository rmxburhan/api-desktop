<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Database\Console\Migrations\ResetCommand;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'kode_obat' => 'required',
            'nama_obat' => 'required',
            'exp_date' => 'required',
            'jumlah' => 'required',
            'harga' => 'required',
        ]);

        Obat::create($data);

        return response([
            'message' => 'success',
        ]);
    }

    public function index(){
        $data = Obat::all();

        return response([
            'data' => $data,
        ]);
    }
    public function update(Request $request, Obat $obat) {
        $data = $request->validate([
            'kode_obat' => 'required',
            'nama_obat' => 'required',
            'exp_date' => 'required',
            'jumlah' => 'required',
            'harga' => 'required',
        ]);

        $obat->update($data);

        return response([
            'message' => 'success',
        ]);
    }

    public function destroy(Obat $obat){
        $obat->delete();

        return response([
            'message' => 'success',
        ]);
    }
}
