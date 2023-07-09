<?php

namespace App\Http\Controllers;

use App\Models\TopAir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Blacklist;
use App\Models\EnDetails;
use App\Models\User;
use App\Models\MinAge;
use Carbon\Carbon;
use App\Models\Watchlists;

class TopAiringController extends Controller
{
    public function prepopulateTopAir(Request $request)
    {
        
        return view('admin.topair.prepopulate');
    }

    public function populateTopAir(Request $request)
    {
        
        return view('admin.topair.populate');
    }

    public function entopairEdit(Request $request,$id)
    {
        $TopAir = TopAir::where('id', $id)->first();
        return view('admin.topair.edit',['topair'=>$TopAir ]);
    }

    public function entopair(Request $request)
    {
        $topair = TopAir::all();
        $blacklist = Blacklist::pluck('animeId')->toArray(); 
        $minage = MinAge::pluck('animeId')->toArray(); 
        return view('admin.topair.index', ['topair' => $topair,'blacklist_animeIds' => $blacklist, 'min_age' => $minage]);
    }

    public function entopairIns(Request $request)
    {
        $TopAir = new TopAir();
        $TopAir->page = $request->input('page');
        $TopAir->animeId = $request->input('animeId');
        $TopAir->animeTitle = $request->input('animeTitle');
        $TopAir->animeImg = $request->input('animeImg');
        $TopAir->latestEp = $request->input('latestEp');
        $TopAir->save();
        return redirect()->route('admin-topAir-manage');
    }  

    public function entopairEditsave(Request $request)
    {
        $id = $request->input('id');
        $animeId = $request->input('validationCustom02');
        $animeTitle = $request->input('validationCustom03');
        $animeImg = $request->input('validationCustom04');
        $latestEp = $request->input('validationCustom05');
        $page = $request->input('validationCustom01');
    
        $update = TopAir::where('id', $id)->first();
    
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

    public function entopairDel(Request $request)
    {
        $animeId = $request->input('animeId');
        $TopAir = TopAir::where('animeId', $animeId)->first();
        $TopAir->delete();
        return back();
    }

    public function GetTopAiring(Request $request,$page)
    {
        $data = TopAir::where('page', $page)->get();    
        $blacklist = Blacklist::pluck('animeId')->toArray(); 
        $watchlist = Watchlists::where('email', Auth::user()->email)->pluck('animeId')->toArray();

        $birthday = Auth::user()->date_of_birth;
        $currentDate = Carbon::now();
        $birthDate = Carbon::createFromFormat('Y-m-d', $birthday);
        $age = $birthDate->diffInYears($currentDate);
        $minage = MinAge::pluck('animeId')->toArray(); 

        return view('english.top-airing', [
            'page'=> $page,
            'data' => $data, 
            'blacklist_animeIds' => $blacklist,
            'watchlist'=>$watchlist,
            'age'=>$age,
            'minagelist'=>$minage
        ]);
    }
}
