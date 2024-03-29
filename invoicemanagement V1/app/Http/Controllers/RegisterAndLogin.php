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
        return view('admindashboard');
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
    public function loginuser()
    {
        return view('auth.login');
    }

    public function dashboard()
    {

        if (Auth::check()) {
            $data1 = Invoice::join('payments', 'payments.invoice_id', '=', 'invoices.id')->get();
            $order = Order::All();
            return view('dashboard', ['orders' => $order, 'data1' => $data1]);
        } else {
            return redirect()->route('login')->withErrors(['email' => 'Please login to access the dashboard.',])->onlyInput('email');
        }
    }

    public function admindashboard()
    {

        if (Auth::check()) {
            $data1 = Invoice::join('payments', 'payments.invoice_id', '=', 'invoices.id')->get();
            $order = Order::All();
            return view('admindashboard', ['orders' => $order, 'data1' => $data1]);
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