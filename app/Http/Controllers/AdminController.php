<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\userActivity;

class AdminController extends Controller
{
    public function index()
    {
        $userActivity = userActivity::all()->reverse();
        return view('admin.index',['userActivity' => $userActivity]);
    }    

}
