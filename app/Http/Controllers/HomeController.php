<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Http;
use App\Models\Blacklist;
use App\Models\Popular;
use App\Models\Recent;
use App\Models\Movies;
use App\Models\GenreEn;
use App\Models\TopAir;
use App\Models\EnDetails;
use App\Models\User;
use App\Models\Watchlists;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $blacklist = Blacklist::pluck('animeId')->toArray(); 

        //popular
        $data = Popular::where('page', 1)->get();    

        //recent
        $data2 = Recent::where('page', 1)->get();

        //movie
        $data3 = Movies::where('page', 1)->get();

        //top airing
        $data4 = TopAir::where('page', 1)->get();

        
        return view('welcome', ['data' => $data,'data2' => $data2,'data3' => $data3,'data4' => $data4, 'blacklist_animeIds' => $blacklist]);
    }

    public function light()
    {
        $email = Auth::user()->email;
        $user = User::where('email', $email )->first();   
        $user->theme = 'light';
        $user->save();
        return back();
    }
    public function dark()
    {
        $email = Auth::user()->email;
        $user = User::where('email', $email )->first();   
        $user->theme = 'dark';
        $user->save();
        return back();
    }

    public function allAnime()
    {
        $all = EnDetails::orderBy('animeId')->get();   
        return view('english.all', ['all' => $all]);
    }

    public function seasonAnime()
    {
        $season = EnDetails::distinct('type')->get(); 
        $all = EnDetails::all();   
        return view('english.season', ['all' => $all,'season' => $season]);
    }

    public function specifyseasonAnime(Request $request,$specify)
    {
        $blacklist = Blacklist::pluck('animeId')->toArray(); 
        $watchlist = Watchlists::where('email', Auth::user()->email)->pluck('animeId')->toArray();
        $season = EnDetails::distinct('type')->get(); 
        $specify = str_replace("-", " ", $specify);
        $results = EnDetails::where('type', $specify)->get();  
        return view('english.specifyseason', [
            'all' => $results,
            'season' => $season,
            'blacklist_animeIds' => $blacklist,
            'watchlist'=>$watchlist]);
    }
    
    
}
