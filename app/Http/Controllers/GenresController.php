<?php

namespace App\Http\Controllers;

use App\Models\GenreEn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Blacklist;
use App\Models\EnDetails;
use App\Models\User;
use App\Models\MinAge;
use App\Models\genreList;
use Carbon\Carbon;
use App\Models\Watchlists;

class GenresController extends Controller
{
    public function prepopulateGenre(Request $request)
    {
        $genre = genreList::all();
        return view('admin.genre.prepopulate', ['genre' => $genre]);
    }

    public function populateGenre(Request $request)
    {
        return view('admin.genre.populate');
    }

    public function GetAnimeGenres(Request $request, $genre, $page)
    {
        $data = GenreEn::where('page', $page)
        ->where('genre', $genre)->get();  
        $name = genreList::where('slug', $genre)->pluck('name')->first();

        $birthday = Auth::user()->date_of_birth;
        $currentDate = Carbon::now();
        $birthDate = Carbon::createFromFormat('Y-m-d', $birthday);
        $age = $birthDate->diffInYears($currentDate);
        $minage = MinAge::pluck('animeId')->toArray(); 

        $blacklist = Blacklist::pluck('animeId')->toArray();
        $watchlist = Watchlists::where('email', Auth::user()->email)->pluck('animeId')->toArray();
        return view('english.genre', [
            'name' => $name,
            'genre' => $genre,
            'page' => $page,
            'data' => $data, 
            'blacklist_animeIds' => $blacklist,
            'watchlist'=>$watchlist,
            'age'=>$age,
            'minagelist'=>$minage
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
        $queryParams = [
            'genre' => $request->input('genre'),
            'page' => $request->input('page'),
        ];
    
        return redirect()->route('admin-genre-manage', $queryParams);
    }

    public function engenre(Request $request)
    {
        $genre = GenreEn::all();
        $blacklist = Blacklist::pluck('animeId')->toArray(); 
        $minage = MinAge::pluck('animeId')->toArray(); 
        $genreList = genreList::all();
        return view('admin.genre.index', ['genre' => $genre,'blacklist_animeIds' => $blacklist, 'min_age' => $minage,'genreList'=>$genreList]);
    }

    public function engenreDel(Request $request)
    {
        $animeId = $request->input('animeId');
        $genre = GenreEn::where('animeId', $animeId)->first();
        $genre->delete();
        return back();
    }

    public function engenreEdit(Request $request,$id)
    {
        $genreList = genreList::all();
        $GenreEn = GenreEn::where('id', $id)->first();
        return view('admin.genre.edit',['GenreEn'=>$GenreEn ,'genreList'=>$genreList]);
    }  

    public function engenreEditsave(Request $request)
    {
        $id = $request->input('id');
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
