<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Order;

class RegisterAndLogin extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create_order()
    {
        return view('order.createorder');
    }

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

    public function dashboard(Request $request)
    {
        $role = Auth::user()->role;
        if (Auth::check() && $role == '1') {
         return view("admin.admindashboard", ['orders' => Order::all(),
            ]);
       
        }
        if (Auth::check() && $role == '2') {
            return view("dashboard.orderreg", ['orders' => Order::all(),]);
        
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
    //change and update pwd
    public function changepassword()
    {
        return view('password.changepassword');
    }
    public function updatepassword(Request $request)
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