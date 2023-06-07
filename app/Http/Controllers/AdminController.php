<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Blacklist;
class AdminController extends Controller
{

    public $enapi = 'https://gogoanime-api-production.up.railway.app';
    public $idapi = 'https://otakudesu-unofficial-api.rzkfyn.tech/api/v1';

    public function index()
    {
        return view('admin.index');
    }

    public function GetPopularAnime(Request $request, $page)
    {
        $response = Http::get($this->enapi .'/popular?page='.$page);
        $data = $response->json();
        $blacklist = Blacklist::pluck('animeId')->toArray(); 
        return view('admin.popular', ['data' => $data, 'blacklist_animeIds' => $blacklist]);
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

}
