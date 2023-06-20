<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\History;

class HistoryController extends Controller
{
    public function index()
    {
        $email = Auth::user()->email; 
        $history = History::select('url')
        ->where('email', $email)
        ->groupBy('url')
        ->get();
        return view('en.history', compact('history'));
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'email' => 'required',
        ]);
    
        History::where('email', $request->email)->delete();
        return back();
    }
    
}
