<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class EventLikeController extends Controller
{
    public function store(Request $request, Event $event)
    {
      return $event->like();
    }

    public function destroy(Event $event)
    {
      if ($event->liked()) {
        return $event->unlike();
      }
    }
}
