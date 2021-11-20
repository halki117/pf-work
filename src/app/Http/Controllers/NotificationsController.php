<?php

namespace App\Http\Controllers;

use App\Notification;
use App\Spot;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    // public function index(){
    //     $notifications = Notification::all();
    //     return view('notifications.index', compact('notifications'));
    // }

    public function store($notifer_id, $passive_user_id, $passive_spot_id, $notice_type){
        $notification = new Notification;

        $notification->notifer_id = $notifer_id;
        $notification->passive_user_id = $passive_user_id;
        $notification->passive_spot_id = $passive_spot_id;
        $notification->notice_type = $notice_type;
        $notification->save();
    }

    public function checked($id){
        $notification = Notification::find($id);
        $notification->checked = true;
        $notification->update();

        $spot = Spot::find($notification->passive_spot_id);
        return view('spots.show', compact('spot'));
    }
}
