<?php

namespace App\Http\Controllers;

use App\Models\Resep;
use App\Models\Transaksi;
use DateTime;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function storeDesktop(Request $request)
    {
         $data = $request->validate([
            'keranjang' => 'required'
         ]);
         try {
            foreach($data['keranjang'] as $item) {

                if ($item['tipe_resep'] == "DENGAN RESEP") {
                    $resep = Resep::create([
                        'no_resep' => $item['no_resep'],
                        'tgl_resep' => $item['tgl_resep'],
                        'nama_pasien' => $item['nama_pasien'],
                        'nama_dokter' => $item['nama_dokter'],
                        'nama_obat' => $item['nama_dokter'],
                        'jumlah_obat' => $item['qty'],
                    ]);
    
                    $transaksi = Transaksi::create([
                        'no_transaksi' => 'INV' . md5(date("YmdHis")),
                        'tgl_transaksi' => date("Y-m-d H:i-s"),
                        'nama_kasir' => $item['nama_kasir'],
                        'total_bayar' => $item['total_harga'],
                        'user_id' => $item['user_id'],
                        'obat_id' => $item['obat_id'],
                        'resep_id' => $resep['id']
                    ]);
    
                } else {
                    $transaksi = Transaksi::create([
                        'no_transaksi' => 'INV' . md5(date("YmdHis")),
                        'tgl_transaksi' => date("Y-m-d H:i-s"),
                        'nama_kasir' => $item['nama_kasir'],
                        'total_bayar' => $item['total_harga'],
                        'user_id' => $item['user_id'],
                        'obat_id' => $item['obat_id'],
                    ]);
                }
            }
            } catch (QueryException $ex) {
                return response([
                    'error' => $ex
                ],500);
            }
            return response([
                'status' => 'success'
            ], 200);
    }

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

        $transaksi = Transaksi::create([
            'no_transaksi' => 'INV' . md5(date("YmdHis")),
            'tgl_transaksi' => date("Y-m-d H:i-s"),
            'nama_kasir' => $request['nama_kasir'],
            'total_bayar' => $request['total_harga'],
            'user_id' => $request['user_id'],
            'obat_id' => $request['obat_id'],
        ]);

        return response([
            'message' => 'success',
        ]);
    }

    public function laporan(Request $request)
    {
        $this->validate($request, [
            'min' => 'date|required',
            'max' => 'date|required',
        ]);

        $from = date($request->min);
        $to = date($request->max . ' 23:59:59');

        $data = DB::table('transaksis')
        ->select('tgl_transaksi', DB::raw('SUM(total_bayar) as total_bayar'))
        ->whereBetween('tgl_transaksi',[$from, $to])
        ->groupBy('tgl_transaksi')
        ->orderByRaw('tgl_transaksi ASC')
        ->get();

        return response([
            'data' => $data
        ]);
    }
}