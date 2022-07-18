<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'no_transaksi' => 'required',
            'tgl_transaksi' => 'required',
            'nama_kasir' => 'required',
            'total_bayar' => 'required',
            'user_id' => 'required',
            'obat_id' => 'required',
        ]);

        Transaksi::create($data);

        return response([
            'message' => 'success',
        ]);
    }
}
