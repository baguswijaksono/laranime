<?php

namespace App\Http\Controllers;

use App\Models\GenreEn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Blacklist;
use App\Models\EnDetails;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Watchlists;

class GenresController extends Controller
{
    public function prepopulateGenre(Request $request)
    {
        $genre = genreList::all();
        return view('admin.prepopulate-genre', ['genre' => $genre]);
    }

    public function populateGenre(Request $request)
    {
        return view('admin.populate-genre');
    }

    public function GetAnimeGenres(Request $request, $genre, $page)
    {
        $data = GenreEn::where('page', $page)
        ->where('genre', $genre)->get();  
        $blacklist = Blacklist::pluck('animeId')->toArray();
        $watchlist = Watchlists::where('email', Auth::user()->email)->pluck('animeId')->toArray();
        return view('english.genre', [
            'data' => $data, 
            'blacklist_animeIds' => $blacklist,
            'watchlist'=>$watchlist
        ]);
    }

    public function engenreIns(Request $request)
    {
        $genre = new GenreEn;
        $genre->page = $request->input('page');
        $genre->genre = $request->input('genre');
        $genre->animeId = $request->input('animeId');
        $genre->animeTitle = $request->input('animeTitle');
        $genre->animeImg = $request->input('animeImg');
        $genre->releasedDate = $request->input('releasedDate');
        $genre->save();
        return redirect()->route('admin-genre-manage');
    }

    public function engenre(Request $request)
    {
        $genre = GenreEn::all();
        $blacklist = Blacklist::pluck('animeId')->toArray(); 
        $minage = MinAge::pluck('animeId')->toArray(); 
        $genreList = genreList::all();
        return view('admin.database-genre-manage', ['genre' => $genre,'blacklist_animeIds' => $blacklist, 'min_age' => $minage,'genreList'=>$genreList]);
    }

    public function engenreDel(Request $request)
    {
        $animeId = $request->input('animeId');
        $genre = GenreEn::where('animeId', $animeId)->first();
        $genre->delete();
        return back();
    }

    public function engenreEdit(Request $request,$animeId)
    {
        $genreList = genreList::all();
        $GenreEn = GenreEn::where('animeId', $animeId)->first();
        return view('admin.database-genre-manage-edit',['GenreEn'=>$GenreEn ,'genreList'=>$genreList]);
    }  

    public function engenreEditsave(Request $request)
    {
        $id = $request->input('validationCustom020');
        $page = $request->input('validationCustom01');
        $genre = $request->input('validationCustom010');
        $animeId = $request->input('validationCustom02');
        $animeTitle = $request->input('validationCustom03');
        $animeImg = $request->input('validationCustom04');
        $releasedDate = $request->input('validationCustom05');
    
        $update = GenreEn::where('id', $id)->first();
    
        if ($update) {
            $update->page = $page;
            $update->genre = $genre;
            $update->animeId = $animeId;
            $update->animeTitle = $animeTitle;
            $update->animeImg = $animeImg;
            $update->releasedDate = $releasedDate;
            $update->save();
    
            $GenreEn = GenreEn::all();
    
            return redirect()->route('admin-genre-manage', ['genre' => $GenreEn]);
        }

        return back()->with('error', 'Record not found');
    }
}
