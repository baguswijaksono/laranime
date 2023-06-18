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

    public $enapi = 'https://gogoanime-api-production.up.railway.app';
    public $idapi = 'https://otakudesu-unofficial-api.rzkfyn.tech/api/v1';

    public function index()
    {
        $userActivity = userActivity::all();
        return view('admin.index',['userActivity' => $userActivity]);
    }

    public function GetPopularAnime(Request $request, $page)
    {
        $response = Http::get($this->enapi .'/popular?page='.$page);
        $data = $response->json();
        $blacklist = Blacklist::pluck('animeId')->toArray(); 
        $minage = MinAge::pluck('animeId')->toArray(); 
        return view('admin.popular', ['data' => $data, 'blacklist_animeIds' => $blacklist, 'min_age' => $minage]);
    }

    public function GetAnimeMovies(Request $request, $page)
    {
        $response = Http::get($this->enapi .'/anime-movies?page='.$page);
        $data = $response->json();
        $blacklist = Blacklist::pluck('animeId')->toArray();
        return view('admin.anime-movies', ['data' => $data, 'blacklist_animeIds' => $blacklist]);
    }

    public function GetRecentEpisodes(Request $request, $page)
    {
        $response = Http::get($this->enapi .'/recent-release?page='.$page);
        $data = $response->json();
        $blacklist = Blacklist::pluck('animeId')->toArray();
        return view('admin.recent-release', ['data' => $data, 'blacklist_animeIds' => $blacklist]);
    }

    public function GetAnimeSearch(Request $request, $keyw)
    {
        $response = Http::get($this->enapi .'/search?keyw='.$keyw);
        $data = $response->json();
        $blacklist = Blacklist::pluck('animeId')->toArray();
        return view('admin.search', ['data' => $data, 'blacklist_animeIds' => $blacklist]);
    }

    public function GetTopAiring(Request $request,$page)
    {
        $response = Http::get($this->enapi .'/top-airing?page='.$page);
        $data = $response->json();
        $blacklist = Blacklist::pluck('animeId')->toArray(); 
        return view('admin.top-airing', ['data' => $data, 'blacklist_animeIds' => $blacklist]);
    }

    public function GetAnimeGenres(Request $request,$genre,$page)
    {
        $response = Http::get($this->enapi .'/genre/'.$genre.'?page='.$page);
        $data = $response->json();
        $blacklist = Blacklist::pluck('animeId')->toArray(); 
        return view('admin.genre', ['data' => $data,'blacklist_animeIds' => $blacklist]);
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
    
        // Handle the case where the record is not found
        // You can redirect back or show an error message
        return back()->with('error', 'Record not found');
    }
    
    

    

    public function enmovie(Request $request)
    {
        $movie = Movies::all();
        $blacklist = Blacklist::pluck('animeId')->toArray(); 
        $minage = MinAge::pluck('animeId')->toArray(); 
    
        return view('admin.database-movie-manage', ['movie' => $movie ,'blacklist_animeIds' => $blacklist, 'min_age' => $minage]);
    }

    public function entopair(Request $request)
    {
        $topair = TopAir::all();
    
        return view('admin.database-topair-manage', ['topair' => $topair]);
    }

    public function enrecent(Request $request)
    {
        $recent = Recent::all();
    
        return view('admin.database-recent-manage', ['recent' => $recent]);
    }

    public function engenre(Request $request)
    {
        $genre = GenreEn::all();
    
        return view('admin.database-genre-manage', ['genre' => $genre]);
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
