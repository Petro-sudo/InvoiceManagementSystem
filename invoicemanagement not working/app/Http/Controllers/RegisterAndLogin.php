<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Order;
use App\Models\Invoice;

class RegisterAndLogin extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function admindash()
    {
        return view('admin.admindashboard');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:250',
            'surname' => 'required|string|max:250',
            'email' => 'required|email|max:250|unique:users',
            'persal' => 'required|numeric|digits:8|unique:users',
            'role' => 'required|integer',
            'password' => 'required|min:8|confirmed',


        ]);

        User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'persal' => $request->persal,
            'role' => $request->role,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);


        Alert::success('Congrates', 'You have successfully registered, you can now login logged in!');
        return redirect()->route('login');
    }

    //view login form
    public function loginuser()
    {
        return view('auth.login');
    }

    // public function dashboard()
    // {

    //     if (Auth::check()) {
    //         $data1 = Invoice::join('payments', 'payments.invoice_id', '=', 'invoices.id')->get();
    //         $order = Order::All();
    //         return view('dashboard', ['orders' => $order, 'data1' => $data1]);
    //     } else {
    //         return redirect()->route('login')->withErrors(['email' => 'Please login to access the dashboard.',])->onlyInput('email');
    //     }
    // }

    // public function admindashboard()
    // {

    //     if (Auth::check()) {
    //         $data1 = Invoice::join('payments', 'payments.invoice_id', '=', 'invoices.id')->get();
    //         $order = Order::All();
    //         return view('admindashboard', ['orders' => $order, 'data1' => $data1]);
    //     }
    // }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
        }

        return back()->withErrors(['email' => 'Your provided credentials do not match in our records.',])->onlyInput('email');
    }

    public function dashboard()
    {
        $role = Auth::user()->role;
        if (Auth::check() && $role == '1') {
            $data1 = Invoice::join('payments', 'payments.invoice_id', '=', 'invoices.id')->get();
            $order = Order::All();
            return view('admin.admindashboard', ['orders' => $order, 'data1' => $data1]);
        }
        if (Auth::check() && $role == '2') {
            return view('auth.dashboardadmin');
        }
        if (Auth::check() && $role == '3') {
            return view('auth.dashboardmentor');
        } else {
            return redirect()->route('login')->withErrors(['email' => 'Please login to access the dashboard.',])->onlyInput('email');
        }
    }

    public function viewOrder()
    {
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->withSuccess('You have logged out successfully!');;
    }
}