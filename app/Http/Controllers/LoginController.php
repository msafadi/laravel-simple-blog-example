<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function create()
    {
        return view('login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $result = Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ]);
        if ($result) {
            return redirect('/admin/posts');
        }

        return redirect('/login')
            ->with('error', 'Invalid credentials');
    }
}
