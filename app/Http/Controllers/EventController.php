<?php

namespace App\Http\Controllers;

use App\Authorizable;
use App\DataTables\EventsDataTable;
use App\Http\Interfaces\EventInterface;
use App\Http\Requests\EventsRequest;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // use Authorizable;
    private $eventInterface;

    public function __construct(EventInterface $eventInterface)
    {
        $this->eventInterface = $eventInterface;
    }

    public function index(EventsDataTable $dataTable)
    {
        return $this->eventInterface->index($dataTable);
    }

    public function create()
    {
        return $this->eventInterface->create();
    }

    public function store(EventsRequest $request)
    {
        $event = $this->eventInterface->store($request->all());
        session()->flash('success', trans('main.added-message'));

        return redirect()->route('events.index');
    }

    public function show($id)
    {
        return $this->eventInterface->show($id);
    }

    public function edit($id)
    {
        return $this->eventInterface->edit($id);
    }

    public function update(EventsRequest $request, $id)
    {
        $event = $this->eventInterface->update($request->all(), $id);
        session()->flash('success', trans('main.updated'));

        return redirect()->route('events.show', [$event->id]);
    }

    public function destroy($id)
    {
        $event = $this->eventInterface->destroy($id);
        session()->flash('success', trans('main.deleted-message'));

        return redirect()->route('events.index');
    }

    public function multi_delete(Request $request)
    {
        return $this->eventInterface->multi_delete($request);
    }
}
