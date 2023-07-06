<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MinAge;
use Illuminate\Support\Facades\Validator;
class MinAgeController extends Controller
{

    public function index()
    {
        $minAge = MinAge::all();
        return view('admin.minage.index', compact('minAge'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'animeId' => 'required|not_exists:blacklists,animeId'
        ], [
            'animeId.required' => 'Anime ID field is required.',
            'animeId.not_exists' => 'Cannot add Anime ID, it exist in the Blacklist table.'
        ]);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        MinAge::create($request->all());
        return back()->with('success', 'Anime added to blacklist successfully.');
    }

    public function update(Request $request)
    {
        $request->validate([
            'animeId' => 'required',
            'minAge' => 'required'
        ]);
        $MinAge = MinAge::findOrFail($request->input('id'));
        $MinAge->update($request->all());
        return back();
    }

    public function destroy(Request $request)
    {
        $animeId = $request->input('animeId');
        $MinAge = MinAge::where('animeId', $animeId)->first();
    
        if ($MinAge) {
            $MinAge->delete();
            return back();
        } else {
            return back();
        }
    }
}
