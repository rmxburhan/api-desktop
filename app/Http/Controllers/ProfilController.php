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
}
