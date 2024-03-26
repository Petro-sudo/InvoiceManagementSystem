<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChangePassword extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function changepassword()
    {
        return view('password.changepassword');
    }

    public function updatepassword(Request $request)
    {
        $request->validate([
            'old_password' => ['required','string','min:8'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        $currentPasswordStatus = Hash::check($request->old_password, auth()->user()->password);
        if($currentPasswordStatus){

            User::findOrFail(Auth::user()->id)->update([
                'password' => Hash::make($request->password),
            ]);

            return redirect()->back()->with('message','You have successfully changed your Password');

        }else{

            return redirect()->back()->with('message','Current Password does not match with Old Password');
        }
    }

    public function changepwd()
    {
        return view('password.adminchangepassword');
    }

    public function updatepwd(Request $request)
    {
        $request->validate([
            'old_password' => ['required','string','min:8'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        $currentPasswordStatus = Hash::check($request->old_password, auth()->user()->password);
        if($currentPasswordStatus){

            User::findOrFail(Auth::user()->id)->update([
                'password' => Hash::make($request->password),
            ]);

            return redirect()->back()->with('message','You have successfully changed your Password');

        }else{

            return redirect()->back()->with('message','Current Password does not match with Old Password');
        }
    }
}


// public function updatepassword(Request $request)
// {
//     $validator = Validator::make($request->all(),[
//         'old_password'=>'required|min:6|max:100',
//         'new_password'=>'required|min:6|max:100',
//         'confirm_password'=>'required|same:new_password'
//         ]);

//         if($validator->fails()){
//             Alert::error('Error', 'Validation fail!');
//     return redirect()->route('changepassword');            
//         }
//         //$current_user=auth()->user();

//         $user=$request->user();
//         if(Hash::check($request->old_password,$user->password )){
//             $user->update(['password'=>Hash::make($request->password)]);
//                 Alert::success('Success', 'New Password created, Please login!');
//                 return redirect()->route('login');          
      
//         }
//         else{
//             Alert::error('Error', 'New password and Old password does not work!');
//             return redirect()->route('changepassword');              
//         }           
    
// }