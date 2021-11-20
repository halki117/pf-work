<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Spot;
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

        // 通知機能
        $notification = app()->make('App\Http\Controllers\NotificationsController');
        $notifer_id = Auth::id();
        $passive_user_id = Spot::find($comment->spot_id)->user->id;
        $passive_spot_id = $request->spot_id;
        $notice_type = 'comment';
        $notification->store($notifer_id, $passive_user_id, $passive_spot_id, $notice_type);
        //

        return redirect(route('spots.show', $request->spot_id))->with('success', 'コメントしました！');
    }

    public function destroy($id){
        $comment = Comment::find($id);
        $comment->delete();
        return redirect(route('spots.show', $comment->spot_id))->with('success', 'コメントを削除しました');
    }
}
