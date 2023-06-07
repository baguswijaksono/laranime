<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Blacklist;
class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

}
