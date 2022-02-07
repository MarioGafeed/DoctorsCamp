<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Authorizable;
use App\Helpers\JsonResponder;
use App\Http\Interfaces\EventInterface;
use App\Http\Requests\EventsRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;


class EventController extends Controller
{
  use Authorizable;

  public function __construct(private EventInterface $eventInterface)
  {
  }

  public function index()
  {
      $events = Event::with('media')->where('active', '1')->paginate(10);

      return EventResource::collection($events);
  }

  public function store(EventsRequest $request)
  {
      $event = $this->eventInterface->store($request->all());

      return new EventResource($event);
  }

  public function show(Event $event)
  {
      return new EventResource($event);
  }


  public function destroy(Event $event)
  {
      $event->delete();

      return JsonResponder::make('Event deleted');
  }
}
