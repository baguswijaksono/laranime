<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blacklist;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), [
            'animeId' => 'required|not_exists:min_ages,animeId'
        ], [
            'animeId.required' => 'Anime ID field is required.',
            'animeId.not_exists' => 'Cannot add Anime ID, it exist in the Min Ages table.'
        ]);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
    
        Blacklist::create($request->all());
    
        return back()->with('success', 'Anime added to blacklist successfully.');
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
