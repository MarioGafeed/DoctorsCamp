<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\NotificationResource;

class UsernotificationsController extends Controller
{
    public function index(string $type = 'all')
    {
      $method = match($type){
        'all' => 'notifications',
        'read' => 'readNotifications',
        'unread' => 'unreadNotifications',
        default => 'notifications'
      };
      // return auth()->user()->notifications()->paginate() ;
      // // dd(  auth()->user()->notifications()->paginate());
      return NotificationResource::collection(
        auth()->user()->$method()->paginate(),
      );
    }

    public function show($id)
    {
      $notification = auth()->user()->Notifications()->findOrFail($id);

      if ($notification ) {

        if ($this->read($id)) {
          $notification->markAsRead();
        }

        // return redirect($notification->data['link']);
      }
    }

    public function read(string $id)
    {

        $notification = auth()->user()->unreadNotifications()->findOrFail($id);

        if ($notification) {
            $notification->markAsRead();
            // return redirect($notification->data['link']);
        }
    }

    public function unread(string $id)
    {
      $notification = auth()->user()->readNotifications()->findOrFail($id);

      $notificationTitle = $notification->data['description'][request()->header('Accept-Language', 'ar')];

      if ($notification) {
          $notification->markAsUnRead();
          return Response()->json([
            'message' => "$notificationTitle marked as unread"
          ]);
      }
    }
}
