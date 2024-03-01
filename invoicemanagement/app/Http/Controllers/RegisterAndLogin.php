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
    protected $user;
    public function __construct()
    {
        $this->middleware('auth');
        $this->user = Auth::User();
    }
    public function create_order()
    {
        return view('order.createorder');
    }

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
            'persal' => 'required|numeric|digits:8|unique:users',
            'role' => 'required|integer',
            'password' => 'required|min:8|confirmed',

        ]);

        $users = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'persal' => $request->persal,
            'role' => $request->role,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        activity('New User Created')->performedOn($users) // Entry add in table. model name(subject_type) & id(su& id(subject_id)
            // Entry add in table. model name(subject_type) & id(subject_id)
            ->causedBy(Auth::user()) //causer_id = admin id, causer type = admin model
            ->log(Auth::user()->email);
        Alert::success('Success', 'New User Created!');
        return redirect()->route('viewusers');
    }

    //view login form
    public function loginuser()
    {
        return view('auth.login');
    }
    public function dashboard()
    {
        $role = Auth::user()->role;
        if (Auth::check() && $role == '1') {
            $data1 = Invoice::join('payments', 'payments.invoice_id', '=', 'invoices.id')->get();
            $order = Order::join('invoices', 'invoices.order_id', '=', 'orders.id')->get();
            return view('admin.admindashboard', ['orders' => $order, 'data1' => $data1]);
        }
        if (Auth::check() && $role == '2') {
            $order = Order::join('invoices', 'invoices.order_id', '=', 'orders.id')->get();
            return view('dashboard.orderreg', ['orders' => $order]);
        }
        if (Auth::check() && $role == '3') {
            $order = Order::join('invoices', 'invoices.order_id', '=', 'orders.id')->get();
            return view('dashboard.invoicecpt', ['orders' => $order]);
        }
        if (Auth::check() && $role == '4') {
            $order = Order::join('invoices', 'invoices.order_id', '=', 'orders.id')->get();
            return view('dashboard.payment', ['orders' => $order]);
        } else {
            return redirect()->route('login')->withErrors(['email' => 'Please login to access the dashboard.',])->onlyInput('email');
        }
    }


    public function createusers()
    {
        return view('users.createuser');
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