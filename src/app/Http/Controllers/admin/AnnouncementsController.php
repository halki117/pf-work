<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Notification;
use App\Announcement;
use App\Http\Controllers\NotificationsController;
use Illuminate\Http\Request;
use App\Http\Requests\AnnouncementRequest;

class AnnouncementsController extends Controller
{
    public function index(){
        $announcements = Announcement::orderBy('created_at', 'desc')->get();
        return view('admin.announcements.index', compact('announcements'));
    }

    public function show($id){
        $announcement = Announcement::find($id);
        return view('admin.announcements.show', compact('announcement'));
    }

    public function create(){
        return view('admin.announcements.create');
    }

    public function store(AnnouncementRequest $request){

        // 一般ユーザーに通知がいく様にNotificationsControllerも動かす
        $notification = app()->make('App\Http\Controllers\NotificationsController');
        $notifer_id = Auth::id();
        $passive_user_id = null;
        $passive_spot_id = null;
        $notice_type = 'announce';
        $notification->store($notifer_id, $passive_user_id, $passive_spot_id, $notice_type);
        //

        $announcement = new Announcement;
        $announcement->title = $request->title;
        $announcement->content = $request->content;
        // 運営が最後に通知した際のNotificationのレコードを取りたい。つまり、created_atの降順の並びだとテーブルの一番最初に目的のレコードが来るので以下の様にして取得する。
        $notification = Notification::orderBy('created_at', 'desc')->first();
        $announcement->notification_id = $notification->id;

        $announcement->save();

        return redirect(route('admin.announcements.index'))->with('success', '通知完了しました');
    }
}
