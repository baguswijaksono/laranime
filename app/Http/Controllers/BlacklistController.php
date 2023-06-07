<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blacklist;

class BlacklistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blacklist = Blacklist::all();
        return view('search', compact('blacklist'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blacklist.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'animeId' => 'required'
        ]);

        Blacklist::create($request->all());
        return redirect('/admin/popular/1');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('blacklist.show', compact('blacklist'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('blacklist.show', compact('blacklist'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'animeId' => 'required'
        ]);

        $blacklist->update($request->all());

        return redirect()->route('blacklist.index')
            ->with('success', 'Data blacklist berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $animeId = $request->input('animeId');
        $blacklist = Blacklist::where('animeId', $animeId)->first();
    
        if ($blacklist) {
            $blacklist->delete();
            return redirect('/admin/popular/1')->with('success', 'Anime dengan ID ' . $animeId . ' berhasil dihapus dari blacklist.');
        } else {
            return redirect('/admin/popular/1')->with('error', 'Anime dengan ID ' . $animeId . ' tidak ditemukan di dalam blacklist.');
        }
    }
    
}
