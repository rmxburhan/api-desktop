<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use Illuminate\Http\Request;

class JenisController extends Controller
{
    public function index() {
        return response([
            'data' => Jenis::all(),
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'jenis_obat' => 'required'
        ]);

        if(Jenis::create([
            'jenis_obat' => $request->jenis_obat        
        ]))
        {
            return response([
                'status' => 'sucess',
                'msg' => 'Data added',
            ], 200);
        }

        return response([
            'status' => 'bad',
            'msg' => 'Data failed to save!'
        ], 400);
    }
}
