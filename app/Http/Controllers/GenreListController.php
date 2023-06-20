<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\genreList;


class GenreListController extends Controller
{

    public function index()
    {
        $genrelist = genreList::all();
        return view('admin.genre-manage', ['genrelist' => $genrelist]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
        ]);
    
        genreList::create($request->all());
        return back();
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
        ]);
    
        $genre = genreList::findOrFail($request->input('id'));
        $genre->update($request->all());
    
        return back();
    }
    
    public function destroy(Request $request)
    {
        $slug = $request->input('slug');
        $genrelist = genreList::where('slug', $slug)->first();
    
        if ($genrelist) {
            $genrelist->delete();
            return back();
        } else {
            return back();
        }
    }
}
