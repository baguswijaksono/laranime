<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comments;
use App\Models\userActivity;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'username' => 'required',
            'role' => 'required',
            'episodeId' => 'required',
            'comment' => 'required',
            'at' => 'required'
        ]);
    
        Comments::create($request->all());
        $date = date('Y-m-d H:i:s');
    
        $user = new userActivity();
        $user->userName = $request->username;
        $user->activityType = "comment";
        $user->episodeId = $request->episodeId;
        $user->animeId = '';
        $user->content = $request->comment;
        $user->at = $date;
        $user->save();
    
        return back();
    }
    
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $commentId = $request->input('id');
        $updatedcomment = $request->input('update');
        $comment = Comments::find($commentId);
        $date = date('Y-m-d H:i:s');
        
        // Update the comment if found
        if ($comment) {
            $comment->comment = $updatedcomment; 
            $comment->at = $date;
            $comment->edited = 'yes';
            $comment->save();
            return back();
        }
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
    $commentId = $request->input('id');
    $user = $request->input('user');
    $comment = Comments::find($commentId);

    // Delete the comment if found
    if ($comment) {
        $comment->delete();
        return back();
    }

    }
    
    
}
