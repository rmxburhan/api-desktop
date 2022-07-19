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
}
