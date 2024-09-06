<?php

// app/Http/Controllers/Auth/LoginController.php

namespace App\Http\Controllers\AuthOld;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email'=>$request->email,'password'=>$request->password,'type'=>1])) {
            //add user to session
            $user = Auth::user();
            $request->session()->put('user', $user);
            //get user from session
            $user = $request->session()->get('user');

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
}
