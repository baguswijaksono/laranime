<?php

namespace App\Http\Controllers;

use App\Models\Popular;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Blacklist;
use App\Models\EnDetails;
use App\Models\User;
use App\Models\MinAge;
use Carbon\Carbon;
use App\Models\Watchlists;

class PopularController extends Controller
{
    public function prepopulatePopular(Request $request)
    {
        
        return view('admin.popular.prepopulate');
    }
    
    public function populatePopular(Request $request)
    {
        
        return view('admin.popular.populate');
    }

    public function enpopularIns(Request $request)
    {
        $popular = new Popular();
        $popular->page = $request->input('page');
        $popular->animeId = $request->input('animeId');
        $popular->animeTitle = $request->input('animeTitle');
        $popular->animeImg = $request->input('animeImg');
        $popular->releasedDate = $request->input('releasedDate');
        $popular->save();
        return redirect()->route('admin-popular-manage');
    }

    public function enpopular(Request $request)
    {
        $popular = Popular::all();
        $blacklist = Blacklist::pluck('animeId')->toArray(); 
        $minage = MinAge::pluck('animeId')->toArray(); 
    
        return view('admin.popular.index', ['popular' => $popular,'blacklist_animeIds' => $blacklist, 'min_age' => $minage]);
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
        return view('admin.popular.edit',['popular'=>$popular ]);
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
        return back()->with('error', 'Record not found');
    }



    public function GetPopularAnime(Request $request, $page)
    {
        $data = Popular::where('page', $page)->get();     
        $blacklist = Blacklist::pluck('animeId')->toArray(); 
        $watchlist = Watchlists::where('email', Auth::user()->email)->pluck('animeId')->toArray();
        $birthday = Auth::user()->date_of_birth;
        $currentDate = Carbon::now();
        $birthDate = Carbon::createFromFormat('Y-m-d', $birthday);
        $age = $birthDate->diffInYears($currentDate);
        return view('english.popular', [
            'data' => $data, 
            'blacklist_animeIds' => $blacklist, 
            'watchlist'=>$watchlist,
            'age'=>$age
        ]);
    }
}
