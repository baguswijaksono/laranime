<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Blacklist;
use App\Models\Comments;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\GenreEn;
use App\Models\EnDetails;
use App\Models\MinAge;
use App\Models\epsList;
use App\Models\History;
use App\Models\Watchlists;
use Carbon\Carbon;

class AnimeController extends Controller
{
    
    public function prepopulateAnime(Request $request)
    {
        
        return view('admin.anime.prepopulate');
    }

    public function populateAnime(Request $request)
    {
        
        return view('admin.anime.populate');
    }

    public function enanimupdate(Request $request)
    {
        $anim = EnDetails::where('id', $request->input('id'))->first();
        $anim->animeId = $request->input('animeId');
        $anim->animeTitle = $request->input('animeTitle');
        $anim->type = $request->input('type');
        $anim->animeImg = $request->input('animeImg');
        $anim->releasedDate = $request->input('releasedDate');
        $anim->status = $request->input('status');
        $anim->genres = $request->input('genres');
        $anim->otherNames = $request->input('otherNames');
        $anim->synopsis = $request->input('synopsis');
        $anim->totalEpisodes = $request->input('totalEpisodes');
        $anim->save();
        return redirect()->route('admin-anime-manage');
    } 

    public function enanimeIns(Request $request)
    {
        $anim = new EnDetails;
        $anim->animeId = $request->input('animeId');
        $anim->animeTitle = $request->input('animeTitle');
        $anim->type = $request->input('type');
        $anim->animeImg = $request->input('animeImg');
        $anim->releasedDate = $request->input('releasedDate');
        $anim->status = $request->input('status');
        $anim->genres = $request->input('genres');
        $anim->otherNames = $request->input('otherNames');
        $anim->synopsis = $request->input('synopsis');
        $anim->totalEpisodes = $request->input('totalEpisodes');
        $anim->save();
        return redirect()->route('admin-anime-manage');
    }

    public function preenanimupdate(Request $request,$id)
    {
        $anim = EnDetails::where('id', $id)->first();
        return view('admin.anime.edit',['anim'=>$anim ]);
    }

    public function enanime(Request $request)
    {
        $endetails = EnDetails::all();
        $blacklist = Blacklist::pluck('animeId')->toArray(); 
        $minage = MinAge::pluck('animeId')->toArray(); 
    
        return view('admin.anime.index', ['endetails' => $endetails,'blacklist_animeIds' => $blacklist, 'min_age' => $minage]);
    }

    public function enanimeDel(Request $request)
    {
        $anim = EnDetails::where('id', $request->input('id'))->first();
        $anim->delete();
        return back();
    }

    public function GetAnimeSearch(Request $request, $keyw)
    {
        $keyw = str_replace("%20", "", $keyw);
        $data = EnDetails::where(function ($query) use ($keyw) {
            $query->where('animeId', 'LIKE', '%' . $keyw . '%')
                ->orWhere('otherNames', 'LIKE', '%' . $keyw . '%');
        })->get();

        $blacklist = Blacklist::pluck('animeId')->toArray(); 
        $watchlist = Watchlists::where('email', Auth::user()->email)->pluck('animeId')->toArray();

        $birthday = Auth::user()->date_of_birth;
        $currentDate = Carbon::now();
        $birthDate = Carbon::createFromFormat('Y-m-d', $birthday);
        $age = $birthDate->diffInYears($currentDate);
        $minage = MinAge::pluck('animeId')->toArray(); 

        return view('english.search', [
            'age'=>$age,
            'minagelist'=>$minage,
            'watchlist'=>$watchlist,
            'data' => $data, 
            'blacklist_animeIds' => $blacklist]);
    }


    public function GetAnimeDetails(Request $request,$anime)
    {
        $data = EnDetails::where('animeId', $anime)->first();
        $episode = epsList::where('animeId', $anime)->get();

        $blacklist = Blacklist::pluck('animeId')->toArray(); 
        $watchlist = Watchlists::where('email', Auth::user()->email)->pluck('animeId')->toArray();

        $birthday = Auth::user()->date_of_birth;
        $currentDate = Carbon::now();
        $birthDate = Carbon::createFromFormat('Y-m-d', $birthday);
        $age = $birthDate->diffInYears($currentDate);
        $minage = MinAge::pluck('animeId')->toArray(); 

        return view('english.anime-details', [
            'data' => $data , 
            'age'=>$age,
            'minagelist'=>$minage,
            'blacklist_animeIds' => $blacklist,
            'watchlist'=>$watchlist,
            'episode' => $episode
        ]);
    }

    public function GetStreamingURLs(Request $request, $episodeId)
    {
        $url = url()->current();
        $userEmail = Auth::user()->email;

        History::where('url', '=', $url)
        ->where('email', '=', $userEmail)
        ->delete();
 
        $history = new History;
        $history->url = $url;
        $history->email = $userEmail; 
        $history->save();

        $commentsArray = Comments::select('id','username', 'role', 'episodeId', 'comment','at','edited')
        ->where('episodeId', $episodeId)
        ->get()
        ->toArray();

        $comments = array_reverse($commentsArray);

        $embedUrl = epsList::where('episodeId', $episodeId)->value('embedUrl');
        $anime = epsList::where('episodeId', $episodeId)->value('animeId');
        $episode_number = epsList::where('episodeId', $episodeId)->value('episodeNum');      
          
        $details = EnDetails::where('animeId', $anime)->first();

        $episode = epsList::where('animeId', $anime)->get();

        $birthday = Auth::user()->date_of_birth;
        $currentDate = Carbon::now();
        $birthDate = Carbon::createFromFormat('Y-m-d', $birthday);
        $age = $birthDate->diffInYears($currentDate);

        $blacklist = Blacklist::pluck('animeId')->toArray(); 
        $minage = MinAge::pluck('animeId')->toArray(); 

        $parts2 = explode('-', $anime);

        $recs = EnDetails::where('animeId', 'LIKE', '%' . $parts2[0] . '%')->get();
        return view('english.watch', [
            'animeId' => $anime,
            'age'=>$age,
            'details' => $details,
            'minagelist'=>$minage,
            'blacklist_animeIds' => $blacklist,
            'episode' => $episode,
            'recs' => $recs,
            'episode_number' => $episode_number,
            'comments' => $comments,
            'x' => $episodeId,
            'embed'=>$embedUrl
        ]);
    }
}
