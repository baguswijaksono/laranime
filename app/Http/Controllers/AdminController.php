<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Blacklist;
class AdminController extends Controller
{
    public function GetRecentEpisodes(Request $request, $page)
    {
        $response = Http::get('http://localhost:3000/recent-release?page='.$page);
        $data = $response->json();
        $blacklist = Blacklist::pluck('animeId')->toArray(); // Mengambil nilai kolom animeId dan menyimpannya ke dalam array
        return view('admin.recent-release', ['data' => $data, 'blacklist_animeIds' => $blacklist]);
    }

    public function GetPopularAnime(Request $request, $page)
    {
        $response = Http::get('http://localhost:3000/popular?page='.$page);
        $data = $response->json();
        $blacklist = Blacklist::pluck('animeId')->toArray(); // Mengambil nilai kolom animeId dan menyimpannya ke dalam array
        return view('admin.popular', ['data' => $data, 'blacklist_animeIds' => $blacklist]);
    }

    public function GetAnimeSearch(Request $request, $keyw)
    {
        $response = Http::get('http://localhost:3000/search?keyw='.$keyw);
        $data = $response->json();
        $blacklist = Blacklist::pluck('animeId')->toArray(); // Mengambil nilai kolom animeId dan menyimpannya ke dalam array
        return view('admin.search', ['data' => $data, 'blacklist_animeIds' => $blacklist]);
    }

    public function GetAnimeMovies(Request $request, $page)
    {
        $response = Http::get('http://localhost:3000/anime-movies?page='.$page);
        $data = $response->json();
        $blacklist = Blacklist::pluck('animeId')->toArray(); // Mengambil nilai kolom animeId dan menyimpannya ke dalam array
        return view('admin.anime-movies', ['data' => $data, 'blacklist_animeIds' => $blacklist]);
    }

    public function GetTopAiring(Request $request,$page)
    {
        $response = Http::get('http://localhost:3000/top-airing?page='.$page);
        $data = $response->json();
        $blacklist = Blacklist::pluck('animeId')->toArray(); // Mengambil nilai kolom animeId dan menyimpannya ke dalam array
        return view('admin.top-airing', ['data' => $data, 'blacklist_animeIds' => $blacklist]);
    }

    public function GetAnimeGenres(Request $request,$genre,$page)
    {
        $response = Http::get('http://localhost:3000/genre/'.$genre.'?page='.$page);
        $data = $response->json();
        return view('genre', ['data' => $data]);
    }

    public function GetAnimeDetails(Request $request,$anime)
    {
        $response = Http::get('http://localhost:3000/anime-details/'.$anime);
        $data = $response->json();
        return view('anime-details', ['data' => $data]);
    }

    public function GetStreamingURLs(Request $request,$episodeId)
    {
        $response = Http::get('http://localhost:3000/vidcdn/watch/'.$episodeId);
        $data = $response->json();
        return view('watch', ['data' => $data]);
    }

    public function GetEpisodeThread(Request $request,$episodeId)
    {
        $response = Http::get('http://localhost:3000/thread/'.$episodeId.'?page=1');
        $data = $response->json();
        return view('thread', ['data' => $data]);
    }
}
