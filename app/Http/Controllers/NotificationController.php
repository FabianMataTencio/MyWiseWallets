<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{ /*
    public function __invoke(Request $request)
    {
        $notifications = auth()->user()->unreadNotifications;
        $notificationsHistory = auth()->user()->readNotifications;

        auth()->user()->unreadNotifications->markAsRead();

        return view('notifications.index', [
            'notifications' => $notifications,
            'notificationsHistory' => $notificationsHistory
        ]);
    } */
    public function index(){
        return view('Notifications.index');
    }

}
