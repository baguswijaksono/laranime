<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\epsList;

class EpisodeController extends Controller
{
    public function enepIns(Request $request)
    {
        $epsList = new epsList();
        $epsList->episodeNum = $request->input('episodeNum');
        $epsList->episodeId = $request->input('episodeId');
        $epsList->animeId = $request->input('animeId');
        $epsList->save();
        return redirect()->route('admin.anime.episode.index',['animeId'=>$request->input('animeId')]);
    }  
    

    public function enanimeEps(Request $request , $animeId)
    {
        $epsList = epsList::where('animeId',$animeId)->get();
    
        return view('admin.anime.episode.index', ['epslist' => $epsList]);
    }

    public function enEpsupdate(Request $request,)
    {
        $ep = epsList::where('id', $request->input('id'))->first();
            $ep->animeId = $request->input('animeId');
            $ep->episodeId = $request->input('episodeId');
            $ep->episodeNum = $request->input('episodeNum');
            $ep->save();
        return back();
    } 
    

    public function enepDel(Request $request)
    {
        $id = $request->input('id');
        $ep = epsList::where('id', $id)->first();
        $ep->delete();
        return back();
    }  
}
