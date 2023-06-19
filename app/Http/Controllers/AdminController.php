<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Blacklist;
use App\Models\MinAge;
use App\Models\Popular;
use App\Models\Movies;
use App\Models\TopAir;
use App\Models\Recent;
use App\Models\GenreEn;
use App\Models\EnDetails;
use App\Models\genreList;
use App\Models\epsList;
use App\Models\User;
use App\Models\userActivity;

class AdminController extends Controller
{
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

    public function index()
    {
        $userActivity = userActivity::all()->reverse();
        return view('admin.index',['userActivity' => $userActivity]);
    }

    public function prepopulatePopular(Request $request)
    {
        
        return view('admin.prepopulate-popular');
    }
    
    public function populatePopular(Request $request)
    {
        
        return view('admin.populate-popular');
    }

    public function prepopulateAnime(Request $request)
    {
        
        return view('admin.prepopulate-anime');
    }

    public function populateAnime(Request $request)
    {
        
        return view('admin.populate-anime');
    }

    public function prepopulateMovie(Request $request)
    {
        
        return view('admin.prepopulate-movie');
    }

    public function populateMovie(Request $request)
    {
        
        return view('admin.populate-movie');
    }

    public function prepopulateTopAir(Request $request)
    {
        
        return view('admin.prepopulate-top-air');
    }

    public function populateTopAir(Request $request)
    {
        
        return view('admin.populate-top-air');
    }

    public function prepopulateRecent(Request $request)
    {
        
        return view('admin.prepopulate-recent');
    }

    public function populateRecent(Request $request)
    {
        
        return view('admin.populate-recent');
    }

    public function prepopulateGenre(Request $request)
    {
        $genre = genreList::all();
        return view('admin.prepopulate-genre', ['genre' => $genre]);
    }

    public function populateGenre(Request $request)
    {
        return view('admin.populate-genre');
    }


    // Database CRUD 

    public function enpopular(Request $request)
    {
        $popular = Popular::all();
        $blacklist = Blacklist::pluck('animeId')->toArray(); 
        $minage = MinAge::pluck('animeId')->toArray(); 
    
        return view('admin.database-popular-manage', ['popular' => $popular,'blacklist_animeIds' => $blacklist, 'min_age' => $minage]);
    }

    public function enpopularDel(Request $request)
    {
        $animeId = $request->input('animeId');
        $popular = Popular::where('animeId', $animeId)->first();
        $popular->delete();
        return back();
    }

    public function enpopularEdit(Request $request,$animeId)
    {
        $popular = Popular::where('animeId', $animeId)->first();
        return view('admin.database-popular-manage-edit',['popular'=>$popular ]);
    }
    public function enpopularEditsave(Request $request)
    {
        $animeId = $request->input('validationCustom02');
        $animeTitle = $request->input('validationCustom03');
        $animeImg = $request->input('validationCustom04');
        $releasedDate = $request->input('validationCustom05');
        $page = $request->input('validationCustom01');
    
        $update = Popular::where('animeId', $animeId)->first();
    
        if ($update) {
            $update->page = $page;
            $update->animeId = $animeId;
            $update->animeTitle = $animeTitle;
            $update->animeImg = $animeImg;
            $update->releasedDate = $releasedDate;
            $update->save();
    
            $popular = Popular::all();
    
            return redirect()->route('admin-popular-manage', ['popular' => $popular]);
        }
        return back()->with('error', 'Record not found');
    }
    
    

    public function enmovie(Request $request)
    {
        $movie = Movies::all();
        $blacklist = Blacklist::pluck('animeId')->toArray(); 
        $minage = MinAge::pluck('animeId')->toArray(); 
        return view('admin.database-movie-manage', ['movie' => $movie ,'blacklist_animeIds' => $blacklist, 'min_age' => $minage]);
    }

    public function enmovieEdit(Request $request,$animeId)
    {
        $movie = Movies::where('animeId', $animeId)->first();
        return view('admin.database-movie-manage-edit',['movie'=>$movie ]);
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

    public function enmovieDel(Request $request)
    {
        $animeId = $request->input('animeId');
        $Movies = Movies::where('animeId', $animeId)->first();
        $Movies->delete();
        return back();
    }
    

    public function entopair(Request $request)
    {
        $topair = TopAir::all();
        $blacklist = Blacklist::pluck('animeId')->toArray(); 
        $minage = MinAge::pluck('animeId')->toArray(); 
        return view('admin.database-topair-manage', ['topair' => $topair,'blacklist_animeIds' => $blacklist, 'min_age' => $minage]);
    }

    public function entopairDel(Request $request)
    {
        $animeId = $request->input('animeId');
        $TopAir = TopAir::where('animeId', $animeId)->first();
        $TopAir->delete();
        return back();
    }

    public function entopairEdit(Request $request,$animeId)
    {
        $TopAir = TopAir::where('animeId', $animeId)->first();
        return view('admin.database-topair-manage-edit',['topair'=>$TopAir ]);
    }

    public function entopairEditsave(Request $request)
    {
        $animeId = $request->input('validationCustom02');
        $animeTitle = $request->input('validationCustom03');
        $animeImg = $request->input('validationCustom04');
        $latestEp = $request->input('validationCustom05');
        $page = $request->input('validationCustom01');
    
        $update = TopAir::where('animeId', $animeId)->first();
    
        if ($update) {
            $update->page = $page;
            $update->animeId = $animeId;
            $update->animeTitle = $animeTitle;
            $update->animeImg = $animeImg;
            $update->latestEp = $latestEp;
            $update->save();
    
            $TopAir = TopAir::all();
    
            return redirect()->route('admin-topAir-manage', ['topair' => $TopAir]);
        }

        return back()->with('error', 'Record not found');
    }
    

    public function enrecent(Request $request)
    {
        $recent = Recent::all();
        $blacklist = Blacklist::pluck('animeId')->toArray(); 
        $minage = MinAge::pluck('animeId')->toArray(); 
        return view('admin.database-recent-manage', ['recent' => $recent,'blacklist_animeIds' => $blacklist, 'min_age' => $minage]);
    }

    public function enrecentEdit(Request $request,$episodeId)
    {
        $Recent = Recent::where('episodeId', $episodeId)->first();
        return view('admin.database-recent-manage-edit',['Recent'=>$Recent ]);
    }

    public function enrecentEditsave(Request $request)
    {
        $page = $request->input('validationCustom01');
        $episodeId = $request->input('validationCustom02');
        $animeTitle = $request->input('validationCustom03');
        $animeImg = $request->input('validationCustom04');
        $episodeNum = $request->input('validationCustom05');
        $subordub = $request->input('validationCustom06');
    
        $update = Recent::where('episodeId', $episodeId)->first();
    
        if ($update) {
            $update->page = $page;
            $update->episodeId = $episodeId;
            $update->animeTitle = $animeTitle;
            $update->episodeNum = $episodeNum;
            $update->subOrDub = $subordub;
            $update->animeImg = $animeImg;
            $update->save();
    
            $Recent = Recent::all();
    
            return redirect()->route('admin-recent-manage', ['recent' => $Recent]);
        }

        return back()->with('error', 'Record not found');
    }
    

    public function enrecentDel(Request $request)
    {
        $episodeId = $request->input('episodeId');
        $Recent = Recent::where('episodeId', $episodeId)->first();
        $Recent->delete();
        return back();
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

    public function enanime(Request $request)
    {
        $endetails = EnDetails::all();
    
        return view('admin.database-anime-manage', ['endetails' => $endetails]);
    }

    public function enanimeEps(Request $request , $animeId)
    {
        $epsList = epsList::where('animeId',$animeId)->get();
    
        return view('admin.database-epsList-manage', ['epslist' => $epsList]);
    }

    public function viewUser()
    {
        $User = User::all();
    
        return view('admin.database-user-manage', ['User' => $User]);
    }
    
    

}
