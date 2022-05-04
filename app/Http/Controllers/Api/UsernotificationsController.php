<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use Illuminate\Http\Request;

class UsernotificationsController extends Controller
{
    public function index(string $type = 'all')
    {
        $method = match ($type) {
            'all' => 'notifications',
            'read' => 'readNotifications',
            'unread' => 'unreadNotifications',
            default => 'notifications'
        };

        return NotificationResource::collection(
            auth()->user()->$method()->paginate(),
        );
    }

    public function read(string $id)
    {
        $notification = auth()->user()->unreadNotifications()->findOrFail($id);

        $notificationTitle = $notification->data['description'][request()->header('Accept-Language', 'ar')];

        $notification->markAsRead();

        return response()->json([
            'message' => "$notificationTitle marked as unread",
        ]);
    }

    public function unread(string $id)
    {
        $notification = auth()->user()->readNotifications()->findOrFail($id);

        $notificationTitle = $notification->data['description'][request()->header('Accept-Language', 'ar')];

        $notification->markAsUnRead();

        return response()->json([
            'message' => "$notificationTitle marked as unread",
        ]);
    }
}
