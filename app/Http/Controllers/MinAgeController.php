<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MinAge;

class MinAgeController extends Controller
{

    public function index()
    {
        $minAge = MinAge::all();
        return view('admin.minage.index', compact('minAge'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'animeId' => 'required',
            'minAge' => 'required'
        ]);

        MinAge::create($request->all());
        return back();
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
