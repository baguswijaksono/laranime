<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Http;
use App\Models\Blacklist;
class HomeController extends Controller
{
        // Englisht Start //
        public $enapi = 'https://gogoanime-api-production.up.railway.app';
        public $idapi = 'https://otakudesu-unofficial-api.rzkfyn.tech/api/v1';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $blacklist = Blacklist::pluck('animeId')->toArray(); 

        //popular
        $response = Http::get($this->enapi . '/popular');
        $data = $response->json();

        //recent
        $response2 = Http::get($this->enapi . '/recent-release');
        $data2 = $response2->json();

        //movie
        $response3 = Http::get($this->enapi . '/anime-movies');
        $data3 = $response3->json();

        //top airing
        $response4 = Http::get($this->enapi . '/top-airing');
        $data4 = $response4->json();

        
        return view('welcome', ['data' => $data,'data2' => $data2,'data3' => $data3,'data4' => $data4, 'blacklist_animeIds' => $blacklist]);
    }

    public function indexId()
    {
        $blacklist = Blacklist::pluck('animeId')->toArray(); 
        $response = Http::get($this->idapi . '/home');
        $data = $response->json();
        
        return view('welcomeId', ['data' => $data, 'blacklist_animeIds' => $blacklist]);
    }
}
