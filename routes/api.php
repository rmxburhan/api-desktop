<?php

use App\Http\Controllers\JenisController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\ResepController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);
Route::middleware('auth:sanctum')->post('/logout', [UserController::class, 'logout']);

Route::middleware('auth:sanctum')->apiResource('/obat', ObatController::class);
Route::middleware('auth:sanctum')->post('/transaksi',[TransaksiController::class, 'store']);
Route::middleware('auth:sanctum')->apiResource('/resep', ResepController::class);
Route::middleware('auth:sanctum')->apiResource('/mnguser', UserController::class);
Route::get('/profil', [ProfilController::class, 'index']);
Route::get('/jenis', [JenisController::class, 'index']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
