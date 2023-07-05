<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comments;
use App\Models\userActivity;

class CommentsController extends Controller
{
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
    
    public function update(Request $request)
    {
        $commentId = $request->input('id');
        $updatedcomment = $request->input('update');
        $comment = Comments::find($commentId);
        $date = date('Y-m-d H:i:s');
        
        if ($comment) {
            $comment->comment = $updatedcomment; 
            $comment->at = $date;
            $comment->edited = 'yes';
            $comment->save();
            return back();
        }
        
        
    }

    public function destroy(Request $request)
    {
    $commentId = $request->input('id');
    $user = $request->input('user');
    $comment = Comments::find($commentId);
    if ($comment) {
        $comment->delete();
        return back();
    }

    }
    
    
}
