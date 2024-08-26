<?php
// app/Http/Controllers/ProfileController.php
// app/Http/Controllers/ProfileController.php
// app/Http/Controllers/ProfileController.php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        //get user data
        $profile = Auth::user();


        return view('profile.edit', ['profile' => $profile]);
    }

    public function update(Request $request)
    {
        $profile = Auth::user();

        $request->validate([
            'password' => 'nullable|string|min:8|confirmed',
        ]);


        if ($request->filled('password')) {
            $profile->password = Hash::make($request->input('password'));
        }

        $profile->save();

        return redirect()->route('profile.edit')->with('status', 'Profile updated!');
    }
}
