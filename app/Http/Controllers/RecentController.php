<?php

namespace App\Http\Controllers;

use App\Models\Recent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Blacklist;
use App\Models\EnDetails;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Watchlists;

class RecentController extends Controller
{
    public function prepopulateRecent(Request $request)
    {
        
        return view('admin.recent.prepopulate');
    }

    public function populateRecent(Request $request)
    {
        
        return view('admin.recent.populate');
    }

    public function GetRecentEpisodes(Request $request, $page)
    {
        $data = Recent::where('page', $page)->get();    
        $blacklist = Blacklist::pluck('animeId')->toArray();
        $watchlist = Watchlists::where('email', Auth::user()->email)->pluck('animeId')->toArray();
        return view('english.recent-release', [
            'data' => $data, 
            'blacklist_animeIds' => $blacklist,
            'watchlist'=>$watchlist,
        ]);
    }

    public function enrecentIns(Request $request)
    {
        $Recent = new Recent();
        $Recent->page = $request->input('page');
        $Recent->episodeId = $request->input('episodeId');
        $Recent->animeTitle = $request->input('animeTitle');
        $Recent->animeImg = $request->input('animeImg');
        $Recent->episodeNum = $request->input('episodeNum');
        $Recent->subOrDub = $request->input('subOrDub');
        $Recent->save();
        return redirect()->route('admin-recent-manage');
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
}
