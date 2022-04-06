<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\JsonResponder;
use App\Http\Interfaces\EventInterface;
use App\Http\Requests\EventsRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;

class EventController extends Controller
{
  public function __construct(private EventInterface $eventInterface)
  {
  }

  public function index(Request $request)
  {
       $events = Event::when($request->keyword, function ($query) use ($request){
             $query->orWhere('title_ar', 'LIKE', "%$request->keyword%")
             ->orWhere('title_en', 'LIKE', "%$request->keyword%")
             ->get();
       })->whereNotNull('title_ar')
     ->where('active', 1)
     ->with('user:id,name')
     ->with('country:id,name')
     ->paginate(10);

      return EventResource::collection($events);
  }

  public function store(EventsRequest $request)
  {
      $event = $this->eventInterface->store($request->all());

      return new EventResource($event);
  }

  public function enroll($eventId, Request $request)
  {
    if (! $request->user()->events->contains($eventId)) {
      $request->user()->events()->attach($eventId);
    }
    else {
      $request->user()->events()->updateExistingPivot($eventId, [
        'status' => 'closed',
      ]);
      return response()->json([
        'message' => "This event close now.."
      ]);
    }

    return response()->json([
      'message' => "Congratulation You Enroll Event Successfully.."
    ]);
  }

  public function disenroll($eventId, Request $request)
  {
    if ( $request->user()->events->contains($eventId)) {
      $request->user()->events()->detach($eventId);
    }

    return response()->json([
      'message' => "Congratulation You disenroll Event Successfully.."
    ]);
  }

  public function userList(Request $request)
  {
    $events = $request->user()->events()->get();
    return EventResource::collection($events);
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
