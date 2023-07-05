<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blacklist;

class BlacklistController extends Controller
{

    public function index()
    {
        $blacklist = Blacklist::all();
        return view('admin.blacklist.index', compact('blacklist'));
    }
    
    public function create()
    {
        return view('blacklist.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'animeId' => 'required'
        ]);

        Blacklist::create($request->all());
        return back();
    }

    public function update(Request $request)
    {
        $request->validate([
            'animeId' => 'required',
            'reason' => 'required'
        ]);
        $blacklist = Blacklist::findOrFail($request->input('id'));
        $blacklist->update($request->all());
        return back();
    }

    public function destroy(Request $request)
    {
        $animeId = $request->input('animeId');
        $blacklist = Blacklist::where('animeId', $animeId)->first();
    
        if ($blacklist) {
            $blacklist->delete();
            return back();
        } else {
            return back();
        }
    }
    
}
