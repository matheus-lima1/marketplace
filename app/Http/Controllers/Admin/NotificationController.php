<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function notifications(){
        $unreadNotifications = auth()->user()->unreadNotifications;

        return view('admin.notifications', compact('unreadNotifications'));
    }

    public function readAll(){
        $unreadNotifications = auth()->user()->unreadNotifications;

        $unreadNotifications->each(function($notification){
            $notification->markAsRead();
        });

        flash('Notificações lidas!')->success();
        return redirect()->back();
    }

    public function read($notification){

        $notification = auth()->user()->notifications()->find($notification);
        $notification->markAsRead();

        flash('Notificação lida!')->success();
        return redirect()->back();

    }
}
