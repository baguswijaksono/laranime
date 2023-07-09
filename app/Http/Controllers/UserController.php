<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function updateUser(Request $request)
    {
        $fullName = $request->input('validationCustom01');
        $dateOfBirth = $request->input('trip-start');
        $email = $request->input('validationCustom03');
        $user = User::where('email', Auth::user()->email)->first();
        $user->name = $fullName;
        $user->email = $email;
        $user->date_of_birth = $dateOfBirth;
        $user->save();
        Session::flash('success', 'User information updated successfully.');
        return back();
    } 
    
    public function savechangePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required','string','min:8'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        $currentPasswordStatus = Hash::check($request->current_password, auth()->user()->password);
        if($currentPasswordStatus){

            User::findOrFail(Auth::user()->id)->update([
                'password' => Hash::make($request->password),
            ]);

            return redirect()->back()->with('message','Password Updated Successfully');

        }else{

            return redirect()->back()->with('message','Current Password does not match with Old Password');
        }
    }
    
    public function changePassword()
    {
        return view('user.change-password');
    }
    
}
