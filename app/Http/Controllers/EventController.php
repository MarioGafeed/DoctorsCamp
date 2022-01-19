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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(EventsDataTable $dataTable)
    {
        return $this->eventInterface->index($dataTable);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->eventInterface->create();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventsRequest $request)
    {
        $event = $this->eventInterface->store($request->all());
        session()->flash('success', trans('main.added-message'));

        return redirect()->route('events.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->eventInterface->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->eventInterface->edit($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EventsRequest $request, $id)
    {
        $event = $this->eventInterface->update($request->all(), $id);
        session()->flash('success', trans('main.updated'));

        return redirect()->route('events.show', [$event->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param  bool  $redirect
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = $this->eventInterface->destroy($id);
        session()->flash('success', trans('main.deleted-message'));

        return redirect()->route('events.index');
    }

    /**
     * Remove the multible resource from storage.
     *
     * @param  array  $data
     * @return \Illuminate\Http\Response
     */
    public function multi_delete(Request $request)
    {
        return $this->eventInterface->multi_delete($request);
    }
}
