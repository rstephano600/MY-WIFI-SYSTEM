<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    // Get unread notifications for current user
    public function index()
    {
        $notifications = Notification::where('user_id', Auth::id())
            ->latest()
            ->take(5)
            ->get();

        return response()->json($notifications);
    }

    // Mark a single notification as read
    public function markAsRead($id)
    {
        $notification = Notification::where('user_id', Auth::id())->findOrFail($id);
        $notification->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }

    // Mark all as read
    public function markAllAsRead()
    {
        Notification::where('user_id', Auth::id())->update(['is_read' => true]);
        return response()->json(['success' => true]);
    }
}
