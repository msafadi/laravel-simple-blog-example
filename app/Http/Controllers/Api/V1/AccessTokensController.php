<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccessTokensController extends Controller
{

    public function index()
    {
        $user = Auth::guard('sanctum')->user();
        return $user->tokens;
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'device_name' => ['nullable']
        ]);

        $user = User::where('email', '=', $request->input('email'))->first();
        if ($user && Hash::check($request->password, $user->password)) {

            $name = $request->input('device_name', $request->userAgent());
            $token = $user->createToken($name);

            return response()->json([
                'token' => $token->plainTextToken,
                'user' => $user,
            ]);
        }

        return response()->json([
            'message' => 'Invalid credentials',
        ], 401);
    }

    public function destroy()
    {
        $user = Auth::guard('sanctum')->user();
        $user->currentAccessToken()->delete();
        return response()->json([]);
    }
}
