<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Notification; // Ensure you have the correct model import

class NotificationController extends Controller
{
    public function index()
    {
        $admin = Auth::user();
        // Ensure the Notification model exists and is used correctly
        $notifications = Notification::where('admin_id', $admin->id)
            ->orderBy('created_at', 'desc')
            ->get();
        dd($notifications); // Check if notifications are retrieved correctly


        return view('notifications.index', compact('notifications'));
    }

    public function showNotifications()
    {
        $user = Auth::user();
        $notificationCount = $user ? $user->unreadNotifications->count() : 0;

        return view('notifications.index', compact('notificationCount'));
    }
    // app/Http/Controllers/NotificationController.php
    public function getUnreadCount()
    {
        $user = auth()->user(); // Supposons que les notifications sont associées à l'utilisateur authentifié
        return $user->notifications()->where('is_read', false)->count();
    }
    public function show($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->update(['is_read' => true]); // Marquer la notification comme lue

        return view('notifications.show', compact('notification'));
    }

}