<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Blacklist;
use App\Models\Watchlists;
use App\Models\Comments;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\History;
use App\Models\Popular;
use App\Models\Recent;
use App\Models\Movies;
use App\Models\GenreEn;
use App\Models\TopAir;
use App\Models\EnDetails;


class ApiController extends Controller
{
    // Englisht Start //
    public $enapi = 'https://gogoanime-api-production.up.railway.app';
    public $idapi = 'https://otakudesu-unofficial-api.rzkfyn.tech/api/v1';

    public function GetRecentEpisodes(Request $request, $page)
    {
        $data = Recent::where('page', $page)
        ->pluck('json')
        ->map(function ($item) {
            return json_decode($item, true);
        })
        ->toArray();
        $data = $data[0];
        $blacklist = Blacklist::pluck('animeId')->toArray();
        $watchlist = Watchlists::where('email', Auth::user()->email)->pluck('animeId')->toArray();
        return view('en.recent-release', [
            'data' => $data, 
            'blacklist_animeIds' => $blacklist]);
    }
    
    public function GetPopularAnime(Request $request, $page)
    {
        $data = Popular::where('page', $page)
        ->pluck('json')
        ->map(function ($item) {
            return json_decode($item, true);
        })
        ->toArray();

        $data = $data[0];        
        $blacklist = Blacklist::pluck('animeId')->toArray(); 
        $watchlist = Watchlists::where('email', Auth::user()->email)->pluck('animeId')->toArray();
        $birthday = Auth::user()->date_of_birth;
        $currentDate = Carbon::now();
        $birthDate = Carbon::createFromFormat('Y-m-d', $birthday);
        $age = $birthDate->diffInYears($currentDate);
        return view('en.popular', [
            'data' => $data, 
            'blacklist_animeIds' => $blacklist, 
            'watchlist'=>$watchlist,
            'age'=>$age
        ]);
    }

    public function GetAnimeSearch(Request $request, $keyw)
    {
        $data = EnDetails::where('anime_id', 'LIKE', '%' . $keyw . '%')
        ->pluck('json')
        ->map(function ($item) {
            return json_decode($item, true);
        })
        ->toArray();

        
        $blacklist = Blacklist::pluck('animeId')->toArray(); 
        $watchlist = Watchlists::where('email', Auth::user()->email)->pluck('animeId')->toArray();
        return view('en.search', [
            'data' => $data, 
            'blacklist_animeIds' => $blacklist]);
    }
    

    public function GetAnimeMovies(Request $request, $page)
    {
        $data = Movies::where('page', $page)
        ->pluck('json')
        ->map(function ($item) {
            return json_decode($item, true);
        })
        ->toArray();
        $data = $data[0];
        $blacklist = Blacklist::pluck('animeId')->toArray(); 
        $watchlist = Watchlists::where('email', Auth::user()->email)->pluck('animeId')->toArray();
        return view('en.anime-movies', [
            'data' => $data, 
            'blacklist_animeIds' => $blacklist]);
    }

    public function GetTopAiring(Request $request,$page)
    {
        $data = TopAir::where('page', $page)
        ->pluck('json')
        ->map(function ($item) {
            return json_decode($item, true);
        })
        ->toArray();
        $data = $data[0];
        $blacklist = Blacklist::pluck('animeId')->toArray(); 
        $watchlist = Watchlists::where('email', Auth::user()->email)->pluck('animeId')->toArray();
        return view('en.top-airing', [
            'data' => $data, 
            'blacklist_animeIds' => $blacklist]);
    }

    public function GetAnimeGenres(Request $request, $genre, $page)
    {
        $data = GenreEn::where('page', $page)
        ->where('genre', $genre) 
        ->pluck('json')
        ->map(function ($item) {
            return json_decode($item, true);
        })
        ->toArray();
        $data = $data[0];
        $blacklist = Blacklist::pluck('animeId')->toArray();
        $watchlist = Watchlists::where('email', Auth::user()->email)->pluck('animeId')->toArray();
        return view('en.genre', [
            'data' => $data, 
            'blacklist_animeIds' => $blacklist]);
    }
    

    public function GetAnimeDetails(Request $request,$anime)
    {
        $data = EnDetails::where('anime_id', $anime)
        ->pluck('json')
        ->map(function ($item) {
            return json_decode($item, true);
        })
        ->toArray();
        $data = $data[0];
        return view('en.anime-details', [
            'data' => $data]);
    }

    public function GetStreamingURLs(Request $request, $episodeId)
    {
        $url = url()->current();
        $userEmail = Auth::user()->email;
        $userName = Auth::user()->name;
    
        $history = new History;
        $history->url = $url;
        $history->email = $userEmail; 
        $history->save();

        $commentsArray = Comments::select('username', 'role', 'episodeId', 'comment')
        ->where('episodeId', $episodeId)
        ->get()
        ->toArray();

        $comments = array_reverse($commentsArray);
        
        $parts = explode('/', $url);
        $title = $parts[5];
        $episode_index = strpos($title, "episode-") + strlen("episode-");
        $episode_number = substr($title, $episode_index);
        $parts2 = explode('-', $title);
        $trimmed_parts2 = array_slice($parts2, 0, count($parts2) - 2);
        $anime = implode('-', $trimmed_parts2);

        $details = EnDetails::where('anime_id', $anime)
        ->pluck('json')
        ->map(function ($item) {
            return json_decode($item, true);
        })
        ->toArray();
        $details = $details[0];


        $recs = EnDetails::where('anime_id', 'LIKE', '%' . $parts2[0] . '%')
        ->pluck('json')
        ->map(function ($item) {
            return json_decode($item, true);
        })
        ->toArray();
    

        return view('en.watch', [
            'details' => $details,
            'details' => $details,
            'recs' => $recs,
            'episode_number' => $episode_number,
            'comments' => $comments,
            'x' => $episodeId
        ]);
    }
    

    // Indonesian Start //
    
    public function GetOngoingAnimeId(Request $request, $page)
    {
        $response = Http::get($this->idapi .'/ongoing-anime/'.$page);
        $details = $response->json();
        $blacklist = Blacklist::pluck('animeId')->toArray(); // Mengambil nilai kolom animeId dan menyimpannya ke dalam array
        return view('id.ongoing', ['details' => $details, 'blacklist_animeIds' => $blacklist]);
    }

    public function GetCompleteAnimeId(Request $request, $page)
    {
        $response = Http::get($this->idapi .'/complete-anime/'.$page);
        $details = $response->json();
        $blacklist = Blacklist::pluck('animeId')->toArray(); // Mengambil nilai kolom animeId dan menyimpannya ke dalam array
        return view('id.completed', ['details' => $details, 'blacklist_animeIds' => $blacklist]);
    }

    public function GetAnimeDetailsid(Request $request, $anime)
    {
        $response = Http::get($this->idapi .'/anime/'.$anime);
        $details = $response->json();
        $blacklist = Blacklist::pluck('animeId')->toArray(); // Mengambil nilai kolom animeId dan menyimpannya ke dalam array
        return view('id.anime-details', ['details' => $details, 'blacklist_animeIds' => $blacklist]);
    }

    public function GetAnimeSearchid(Request $request, $keyw)
    {
        $response = Http::get($this->idapi .'/search/'.$keyw);
        $details = $response->json();
        $blacklist = Blacklist::pluck('animeId')->toArray(); // Mengambil nilai kolom animeId dan menyimpannya ke dalam array
        return view('id.search', ['details' => $details, 'blacklist_animeIds' => $blacklist]);
    }

    public function GetStreamingURLsid(Request $request, $anime, $episodeId)
    {
        $response = Http::get($this->idapi . '/anime/' . $anime . '/episodes/' . $episodeId);
        $details = $response->json();
        $details = Http::get($this->idapi . '/anime/' . $anime);
        $details2 = $details->json();
        $blacklist = Blacklist::pluck('animeId')->toArray(); 
        return view('id.watch', ['details' => $details, 'blacklist_animeIds' => $blacklist, 'details' => $details2]);
    }
    

}


