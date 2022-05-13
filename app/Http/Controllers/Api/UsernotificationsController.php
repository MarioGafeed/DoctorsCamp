<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
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

    public function update(Request $request)
    {
      $user = $request->user();
      $user->fcm_token = $request->token;
      $checkUpdate = (bool) $user->update();
      if ($checkUpdate) {
        return response()->json(['Token successfully stored.']);
      }else {
        return 0;
      }
    }

    public function send(Request $request)
    {
        return $this->sendNotification( array(
          "title" => "Laravel:: Check Learning Apllication(Title)",
          "body" => "Laravel:: This is Test message body (Body)"
        ));
    }

    public function sendNotification($message)
    {
        // Another Code
        $url = 'https://fcm.googleapis.com/fcm/send';
        $FcmToken = User::whereNotNull('fcm_token')->pluck('fcm_token')->all();

        $serverKey = 'AAAAXuG54XA:APA91bFh45y7a7wH3QLQLxGQ355lAt8e89kxl4FEZ8vrafmODvWkRVXCnAVu53H3MYugaOFIE60PUMQk147zVm2FY6cI47Y5YydjWKboGFoRGc1zKSWhfgM7HgDStyYNt0yxXIeF-Wx9';

        $data = [
            "registration_ids" => $FcmToken,
            "notification"     => $message
        ];
        $encodedData = json_encode($data);

        $headers = [
            'Authorization:key=' . $serverKey,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);

        // Execute post
        $result = curl_exec($ch);

        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }

        // Close connection
        curl_close($ch);

        // FCM response
        dd($result);
    }
}
