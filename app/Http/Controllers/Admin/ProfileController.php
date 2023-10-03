<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('admin.profile.edit', [
            'user' => $user
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'birthday' => ['nullable', 'date'],
        ]);

        $profile = Auth::user()->profile;

        $profile->first_name = $request->input('first_name');
        $profile->last_name = $request->input('last_name');
        $profile->birthday = $request->input('birthday');
        $profile->save();

        return back()->with('success', 'Profile updated!');
    }
}
