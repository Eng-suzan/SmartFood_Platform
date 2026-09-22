<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display notifications.
     */
    public function index()
    {
        $notifications = auth()->user()
            ->notifications()
            ->latest()
            ->get();

        return view('notifications.index', compact('notifications'));
    }

    /**
     * Mark one notification as read.
     */
  
public function read($id)
{
    $notification = auth()->user()
        ->notifications()
        ->findOrFail($id);

    $notification->markAsRead();

    if (!empty($notification->data['url'])) {
        return redirect($notification->data['url']);
    }

    return redirect()->route('notifications.index');
}



    /**
     * Mark all notifications as read.
     */
    public function readAll()
    {
        auth()->user()
            ->unreadNotifications
            ->markAsRead();

        return redirect()->back();
    }
}

