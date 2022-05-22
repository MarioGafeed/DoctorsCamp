<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class EventLikeController extends Controller
{
    public function action(Request $request, Event $event)
    {
      if ($event->liked()) {
        return $event->unlike();
      }else {
        return $event->like();
      }
    }
}
