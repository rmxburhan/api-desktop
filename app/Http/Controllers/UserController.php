<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\User;
use Exception;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use League\CommonMark\Extension\SmartPunct\ReplaceUnpairedQuotesListener;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('app')->plainTextToken;
            $payload = Auth::user();
            Log::create([
                'waktu' => date('Y-m-d H:i:s'),
                'aktifitas' => 'login',
                'user_id' => $payload["id"],
            ]);
            return response([
                'token' => $token,
                'payload' => $payload,
            ]);
        }

        return response([
            'message' => 'login fail',
        ], 401);
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required',
            'username' => 'required',
            'alamat' => 'required',
            'password' => 'required',
        ]);

        try {
            User::create([
                'nama' => $data["nama"],
                'username' => $data["username"],
                'alamat' => $data["alamat"],
                'password' => Hash::make($data['password']),
            ]);
        } catch (Exception $ex) {
            return response([
                'message' => $ex
            ], 400);
        }

        return response([
            'message' => 'success'
        ]);
    }

    public function logout()
    {
        auth()->user()->currentAccessToken()->delete();

        return response([
            'message' => 'success',
        ]);
    }
}
