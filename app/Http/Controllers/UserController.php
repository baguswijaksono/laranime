<?php

namespace App\Http\Controllers;
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
    
}
