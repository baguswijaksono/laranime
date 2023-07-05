<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Watchlists;

class WatchListController extends Controller
{

    public function index()
    {
        $email = Auth::user()->email; 
        $watchlist = Watchlists::where('email', Auth::user()->email)->pluck('animeId')->toArray();
        return view('user.watch-list', [
            'watchlist'=>$watchlist]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'animeId' => 'required'
        ]);

        Watchlists::create($request->all());
        return back();
    }

    public function destroy(Request $request)
    {
        $animeId = $request->input('animeId');
        $userEmail = Auth::user()->email;
    
        $Watchlist = Watchlists::where('animeId', $animeId)
                              ->where('email', $userEmail)
                              ->first();
        $Watchlist->delete();
        return back();
    }
    
}
