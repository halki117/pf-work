<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function index(){
        $notifications = Notification::all();
        return view('notifications.index', compact('notifications'));
    }
}
