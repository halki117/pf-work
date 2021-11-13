<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(Request $request){
        $comment = new Comment;
        $comment->content = $request->content;
        $comment->spot_id = $request->spot_id;
        $comment->user_id = Auth::id();
        $comment->save();
        return redirect(route('spots.show', $request->spot_id))->with('success', 'コメントしました！');
    }
}