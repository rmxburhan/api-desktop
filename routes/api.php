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

Route::middleware('auth:sanctum')->prefix('/' , function() {
    Route::post('/logout', [UserController::class, 'logout']);
    Route::apiResource('/resep', ResepController::class);
    Route::apiResource('/obat', ObatController::class);
    Route::post('/transaksi',[TransaksiController::class, 'store']);
    Route::post('/laporan',[TransaksiController::class, 'laporan']);
    Route::post('/log',[UserController::class, 'getLog']);
    Route::post('/transaksi-desktop',[TransaksiController::class, 'storeDesktop']);
});

Route::middleware('auth:sanctum')->prefix('/user', function() {
    Route::get('/', [UserController::class, 'index']);
    Route::post('/', [UserController::class, 'store']);
    Route::put('/{user}', [UserController::class, 'update']);
    Route::delete('/{user}', [UserController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->prefix('/resep', function() {
    Route::get('/', [ResepController::class, 'index']);
    Route::put('/{resep}', [ResepController::class, 'update']);
    Route::delete('/{resep}', [ResepController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->get('/me', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->post('/profil', [ProfilController::class, 'update']);
Route::middleware('auth:sanctum')->get('/profil', [ProfilController::class, 'index']);
Route::get('/jenis', [JenisController::class, 'index']);


