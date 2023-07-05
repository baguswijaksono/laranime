<?php

namespace App\Http\Controllers;

use App\Models\Movies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Blacklist;
use App\Models\EnDetails;
use App\Models\User;
use App\Models\MinAge;
use Carbon\Carbon;
use App\Models\Watchlists;

class MovieController extends Controller
{
    public function prepopulateMovie(Request $request)
    {
        
        return view('admin.movie.prepopulate');
    }

    public function populateMovie(Request $request)
    {
        
        return view('admin.movie.populate');
    }

    public function enmovieIns(Request $request)
    {
        $Movies = new Movies();
        $Movies->page = $request->input('page');
        $Movies->animeId = $request->input('animeId');
        $Movies->animeTitle = $request->input('animeTitle');
        $Movies->animeImg = $request->input('animeImg');
        $Movies->releasedDate = $request->input('releasedDate');
        $Movies->save();
        return redirect()->route('admin-movie-manage');
    }  

    public function enmovie(Request $request)
    {
        $movie = Movies::all();
        $blacklist = Blacklist::pluck('animeId')->toArray(); 
        $minage = MinAge::pluck('animeId')->toArray(); 
        return view('admin.movie.index', ['movie' => $movie ,'blacklist_animeIds' => $blacklist, 'min_age' => $minage]);
    }
    
    public function enmovieDel(Request $request)
    {
        $animeId = $request->input('animeId');
        $Movies = Movies::where('animeId', $animeId)->first();
        $Movies->delete();
        return back();
    }

    public function enmovieEdit(Request $request,$animeId)
    {
        $movie = Movies::where('animeId', $animeId)->first();
        return view('admin.movie.edit',['movie'=>$movie ]);
    }

    public function enmovieEditsave(Request $request)
    {
        $animeId = $request->input('validationCustom02');
        $animeTitle = $request->input('validationCustom03');
        $animeImg = $request->input('validationCustom04');
        $releasedDate = $request->input('validationCustom05');
        $page = $request->input('validationCustom01');
    
        $update = Movies::where('animeId', $animeId)->first();
    
        if ($update) {
            $update->page = $page;
            $update->animeId = $animeId;
            $update->animeTitle = $animeTitle;
            $update->animeImg = $animeImg;
            $update->releasedDate = $releasedDate;
            $update->save();
    
            $movie = Movies::all();
    
            return redirect()->route('admin-movie-manage', ['movie' => $movie]);
        }

        return back()->with('error', 'Record not found');
    }

    public function GetAnimeMovies(Request $request, $page)
    {
        $data = Movies::where('page', $page)->get();    
        $blacklist = Blacklist::pluck('animeId')->toArray(); 
        $watchlist = Watchlists::where('email', Auth::user()->email)->pluck('animeId')->toArray();
        $birthday = Auth::user()->date_of_birth;
        $currentDate = Carbon::now();
        $birthDate = Carbon::createFromFormat('Y-m-d', $birthday);
        $age = $birthDate->diffInYears($currentDate);
        $minage = MinAge::pluck('animeId')->toArray(); 
        return view('english.anime-movies', [
            'page'=> $page,
            'data' => $data, 
            'blacklist_animeIds' => $blacklist,
            'watchlist'=>$watchlist,
            'age'=>$age,
            'minagelist'=>$minage
        ]);
    }

}
