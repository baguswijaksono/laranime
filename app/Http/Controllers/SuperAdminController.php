<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public function viewUser()
    {
        $User = User::all();
    
        return view('superadmin.user-manage', ['User' => $User]);
    }

    public function promoteToAdmin(Request $request)
    {
        $email = $request->input('email');
        $user = User::where('email', $email )->first();   
        $user->role = 'admin';
        $user->save();
        return back();
    }

    public function delete(Request $request)
    {
        $email = $request->input('email');
        $user = User::where('email', $email )->first();   
        $user->delete();
        return back();
    }
}
