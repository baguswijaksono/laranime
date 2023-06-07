<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blacklist;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    // Englisht Start //
    public $enapi = 'https://gogoanime-api-production.up.railway.app';
    public $idapi = 'https://otakudesu-unofficial-api.rzkfyn.tech/api/v1';

    public function GetRecentEpisodes(Request $request, $page)
    {
        $response = Http::get($this->enapi . '/recent-release?page=' . $page);
        $data = $response->json();
        $blacklist = Blacklist::pluck('animeId')->toArray();
        return view('en.recent-release', ['data' => $data, 'blacklist_animeIds' => $blacklist]);
    }
    

    public function GetPopularAnime(Request $request, $page)
    {
        $response = Http::get($this->enapi . '/popular?page='.$page);
        $data = $response->json();
        $blacklist = Blacklist::pluck('animeId')->toArray(); // Mengambil nilai kolom animeId dan menyimpannya ke dalam array
        return view('en.popular', ['data' => $data, 'blacklist_animeIds' => $blacklist]);
    }

    public function GetAnimeSearch(Request $request, $keyw)
    {
        $response = Http::get($this->enapi . '/search?keyw='.$keyw);
        $data = $response->json();
        $blacklist = Blacklist::pluck('animeId')->toArray(); // Mengambil nilai kolom animeId dan menyimpannya ke dalam array
        return view('en.search', ['data' => $data, 'blacklist_animeIds' => $blacklist]);
    }
    

    public function GetAnimeMovies(Request $request, $page)
    {
        $response = Http::get($this->enapi . '/anime-movies?page='.$page);
        $data = $response->json();
        $blacklist = Blacklist::pluck('animeId')->toArray(); // Mengambil nilai kolom animeId dan menyimpannya ke dalam array
        return view('en.anime-movies', ['data' => $data, 'blacklist_animeIds' => $blacklist]);
    }

    public function GetTopAiring(Request $request,$page)
    {
        $response = Http::get($this->enapi . '/top-airing?page='.$page);
        $data = $response->json();
        $blacklist = Blacklist::pluck('animeId')->toArray(); // Mengambil nilai kolom animeId dan menyimpannya ke dalam array
        return view('en.top-airing', ['data' => $data, 'blacklist_animeIds' => $blacklist]);
    }

    public function GetAnimeGenres(Request $request, $genre, $page)
    {
        $response = Http::get($this->enapi . '/genre/' . $genre . '?page=' . $page);
        $data = $response->json();
        $blacklist = Blacklist::pluck('animeId')->toArray();
        return view('en.genre', ['data' => $data, 'blacklist_animeIds' => $blacklist]);
    }
    

    public function GetAnimeDetails(Request $request,$anime)
    {
        $response = Http::get($this->enapi . '/anime-details/'.$anime);
        $data = $response->json();
        return view('en.anime-details', ['data' => $data]);
    }

    public function GetStreamingURLs(Request $request,$episodeId)
    {
        $response = Http::get($this->enapi . '/vidcdn/watch/'.$episodeId);
        $data = $response->json();
        $url = url()->current(); 
        $parts = explode('/', $url); 
        $title = $parts[5]; 
        $episode_index = strpos($title, "episode-") + strlen("episode-"); 
        $episode_number = substr($title, $episode_index); 
        $parts2 = explode('-', $title);
        $trimmed_parts2 = array_slice($parts2, 0, count($parts2) - 2); 
        $anime = implode('-', $trimmed_parts2); 
        $response2 = Http::get($this->enapi . '/anime-details/'.$anime);
        $details = $response2->json();
        $rec = Http::get($this->enapi . '/search?keyw='.$parts2[0]);
        $recs = $rec->json();
        return view('en.watch', ['data' => $data, 'details'=>$details,'recs'=>$recs, 'episode_number'=>$episode_number]);
    }

    // Indonesian Start //
    
    public function GetRecentEpisodesid(Request $request, $page)
    {
        $response = Http::get('https://aniyoi-api.vercel.app/nanime/recent?page='.$page);
        $data = $response->json();
        $blacklist = Blacklist::pluck('animeId')->toArray(); // Mengambil nilai kolom animeId dan menyimpannya ke dalam array
        return view('id.recent-release', ['data' => $data, 'blacklist_animeIds' => $blacklist]);
    }

    public function GetAnimeSearchid(Request $request, $keyw)
    {
        $response = Http::get('https://aniyoi-api.vercel.app/nanime/search?query='.$keyw.'&page='.$page);
        $data = $response->json();
        $blacklist = Blacklist::pluck('animeId')->toArray(); // Mengambil nilai kolom animeId dan menyimpannya ke dalam array
        return view('id.search', ['data' => $data, 'blacklist_animeIds' => $blacklist]);
    }

    public function GetAnimeDetailsid(Request $request, $anime)
    {
        $response = Http::get('https://aniyoi-api.vercel.app/nanime/anime/'.$anime);
        $data = $response->json();
        $blacklist = Blacklist::pluck('animeId')->toArray(); // Mengambil nilai kolom animeId dan menyimpannya ke dalam array
        return view('id.anime-details', ['data' => $data, 'blacklist_animeIds' => $blacklist]);
    }

    public function GetStreamingURLsid(Request $request, $anime, $episodeId)
    {
        $response = Http::get($this->idapi . '/anime/' . $anime . '/episodes/' . $episodeId);
        $data = $response->json();
        $details = Http::get($this->idapi . '/anime/' . $anime);
        $details2 = $details->json();
        $blacklist = Blacklist::pluck('animeId')->toArray(); 
        return view('id.watch', ['data' => $data, 'blacklist_animeIds' => $blacklist, 'details' => $details2]);
    }
    

}

