<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Invoice;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ViewUsers extends Controller
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

    //admin profile
    public function adminprofile()
    {

        $users = Auth::user();
        if ($users->id != auth()->id()) {
            abort(code: 403);
        }
        $user = User::where('id', $users->id)->get();
        return view('admin.view-profile')->with('user', $user);
    }
    public function adminedit($users)
    {
        $users = User::find($users);
        return view('admin.editadmin')->with('users', $users);
    }
    // public function adminedit()
    // {
    //     $users = Auth::user();
    //     if ($users->id != auth()->id()) {
    //         abort(code: 403);
    //     }
    //     $users = User::find($users);
    //     return view('admin.editadmin')->with('users', $users);
    // }
    public function updateadmin(User $users, Request $request)
    {
        $data = $request->validate([

            'name' => 'required|string|max:250',
            'surname' => 'required|string|max:250',
            'persal' => 'required|numeric|digits:8',

        ]);

        $users->update($data);
        Alert::success('Success', 'You have Updated Your Profile');
        return redirect()->route('viewusers');
        //->with('suceess','msg for success')
    }

    //UserProfile
    public function userprofile()
    {

        $users = Auth::user();
        if ($users->id != auth()->id()) {
            abort(code: 403);
        }

        $user = User::where('id', $users->id)->get();
        return view('dashboard.profile')->with('user', $user);
    }
    public function useredit($users)
    {
        $users = User::find($users);
        return view('dashboard.edituser')->with('users', $users);
    }
    public function updateuserss(User $users, Request $request)
    {
        if ($users->id != auth()->id()) {
            //abort(code: 403);
            return redirect()->route('login');
        }

        $data = $request->validate([

            'name' => 'required|string|max:250',
            'surname' => 'required|string|max:250',
            'persal' => 'required|numeric|digits:8',
        ]);

        $users->update($data);
        Alert::success('Success', 'You have Updated Your Profile');
        return redirect()->route('user');
        //->with('suceess','msg for success')

    }
    //view all users
    public function viewusers()
    {
        $users = DB::select('SELECT * FROM `users` WHERE `role` = 2 OR `role` = 3 OR `role` = 4');
        return view('users.viewusers', ['users' => $users]);
    }
    public function edit($users)
    {
        $users = User::find($users);
        return view('users.edit')->with('users', $users);
    }
    public function updateuser(User $users, Request $request)
    {
        $data = $request->validate([

            //'persal' => 'required|numeric|digits:8',
            'role' => 'required|integer',
            //'password' => 'required|min:8|confirmed',
            //'mentorID' => 'required'
        ]);
        $users->update($data);
        Alert::success('Success', 'User Successfully Updated');
        return redirect()->route('viewusers');
        //->with('suceess','msg for success')
        

    }

    public function viewauthorizer()
    {
        $orders = DB::select('SELECT * FROM `users` WHERE  `role` = 4 ');
        return view('users.viewauthorizers', ['orders' => $orders]);
    }
    public function viewcapture()
    {
        $orders = DB::select('SELECT * FROM `users` WHERE  `role` = 3');
        return view('users.viewcapture', ['orders' => $orders]);
    }
    public function viewregister()
    {
        $orders = DB::select('SELECT * FROM `users` WHERE  `role` = 2');
        return view('users.viewregister', ['orders' => $orders]);
    }
}