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
            'password' => 'required'
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

    public function index()
    {
        $data = User::all();

        return response([
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required',
            'tipe_user' => 'required',
            'username' => 'required',
            'alamat' => 'required',
            'password' => 'required',
            'telepon' => 'required',
        ]);

        try {
            User::create($data);
        } catch (Exception $ex) {
            return response([
                'message' => $ex
            ], 400);
        }

        return response([
            'message' => 'success'
        ], 200);
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'nama' => 'required',
            'username' => 'required',
            'tipe_user' => 'required',
            'password' => 'required',
            'telepon' => 'required',
            'alamat' => 'required'
        ]); 

        try {
            $user->update($data);
        } catch (Exceptipn $ex) {
            return response([
                'message' => 'error'
            ], 400);
        }

        return response([
            'message' => 'success'
        ], 200);
    }

    public function destroy(User $user) {
        try {
            $user->delete();
        } catch (Exception $ex) {
            return response([
                'message' => 'error'
            ], 400);
        }

        return response([
            'message' => 'success'
        ], 200);
    }
}
