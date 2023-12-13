<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

class RegisterAndLogin extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:250',
            'surname' => 'required|string|max:250',
            'email' => 'required|email|max:250|unique:users',
            'password' => 'required|min:8|confirmed',

        ]);

        User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        Alert::success('Congrates', 'You have successfully registered, you can now login logged in!');
        return redirect()->route('login');
    }

    //view login form
    public function login()
    {
        return view('auth.login');
    }

    //authenticate user
    // public function authenticate(Request $request)
    // {
    //     $credentials = $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required'
    //     ]);

    //     if (Auth::attempt($credentials)) {
    //         $request->session()->regenerate();
    //         //return redirect()->route('dashboard')->withSuccess('You have successfully logged in!');
    //     }

    //     return back()->withErrors(['email' => 'Your provided credentials do not match in our records.',])->onlyInput('email');

    // }

    /**
     * Display a dashboard to authenticated users.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        
        if (Auth::check() ) {
             return view('dashboard');
       }
    //     if (Auth::check() && $role == '2') {
    //         return view('auth.dashboardadmin');
    //     } 
    //     if (Auth::check() && $role == '3') {
    //         return view('auth.dashboardmentor');
        else {
            return redirect()->route('login')->withErrors(['email' => 'Please login to access the dashboard.',])->onlyInput('email');
        }
    }


    //Log out the user from application.

    // public function logout(Request $request)
    // {
    //     Auth::logout();
    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();
    //     return redirect()->route('login')->withSuccess('You have logged out successfully!');
    //     ;
    // }
}
