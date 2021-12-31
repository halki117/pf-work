<?php

namespace App\Http\Controllers;

use App\Notification;
use App\Announcement;
use App\Spot;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function store($notifer_id, $passive_user_id, $passive_spot_id, $notice_type){
        $notification = new Notification;

        $notification->notifer_id = $notifer_id;
        $notification->passive_user_id = $passive_user_id;
        $notification->passive_spot_id = $passive_spot_id;
        $notification->notice_type = $notice_type;
        $notification->save();
        
        if($notice_type === 'announce'){
            $notification_id = $notification->id;
            return $notification_id;
        }
    }

    public function checked($id){
        $notification = Notification::find($id);
        $notification->checked = true;
        $notification->update();

        if($notification->notice_type === 'like' || $notification->notice_type === 'comment'){
            $spot = Spot::find($notification->passive_spot_id);
            return view('spots.show', compact('spot'));
        }

        if($notification->notice_type === 'announce'){
            $announcement = Announcement::find($notification->announcement->id);
            return view('notifications.announce', compact('announcement'));
        }
    }

    // お知らせの詳細画面
    public function announce($id){
        $announcement = Announcement::find($id);
        return view('notifications.announce', compact('announcement'));
    }
}
