<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\eventInterface;
use App\Http\Traits\EventTrait;
use App\Models\Event;
use App\Models\Country;
use Illuminate\Http\Request;


class EventRepository implements eventInterface
{
  private $viewPath = 'backend.events';
  use EventTrait;
  private $eventModel;
  private $countryModel;

  public function __construct(Event $event, Country $country)
  {
      $this->eventModel = $event;
      $this->countryModel   = $country;
  }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($dataTable)
    {
      return $dataTable->render("{$this->viewPath}.index", [
          'title' => trans('main.show-all') . ' ' . trans('main.events')
      ]);
    }

    public function create()
    {
      $countries = $this->getAllCountries();
      return view("{$this->viewPath}.create", [
          'title' => trans('main.add') . ' ' . trans('main.events'),
          'countries' => $countries
      ]);
    }

    public function store($request)
    {
      $requestAll = $request->all();
      $requestAll['description'] = json_encode([
        'en' => $request->description_en,
        'ar' => $request->description_ar,
      ]);

      $requestAll['user_id'] = auth()->user()->id;

      $event = Event::create($requestAll);
      if ($request->hasFile('image')) {
        $event->addMediaFromRequest('image')->toMediaCollection();
      }

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
      $event = $this->getById($id);    
      return view("{$this->viewPath}.show", [
          'title' => trans('main.show') . ' ' . trans('main.event') . ' : ' . $event->title_ar,
          'show' => $event,
      ]);
    }


    public function edit($id)
    {
      $event      = $this->getById($id);
      $countries  = $this->getAllCountries();


      $event['description_en'] = json_decode($event->description)->en;
      $event['description_ar'] = json_decode($event->description)->ar;
      return view("{$this->viewPath}.edit", [
          'title' => trans('main.edit') . ' ' . trans('main.event') . ' : ' . $event->title,
          'edit' => $event,
          'countries' => $countries,
      ]);
    }

    public function update($request, $id)
    {
      $event = $this->getById($id);
      if (!$event) {
        return back();
      }
      $event->title_en   = $request->title_en;
      $event->title_en   = $request->title_en;
      $event->country_id = $request->country_id;
      $event->city       = $request->city;
      $event->location   = $request->location;
      $event->start_date = $request->start_date;
      $event->end_date   = $request->end_date;
      $event->description= json_encode([
        'en' => $request->description_en,
        'ar' => $request->description_ar,
      ]);
      $event->active = $request->active;
      $event->user_id = auth()->user()->id;

      if ($request->hasFile('image')) {
        $event->clearMediaCollection();
        $event
          ->addMediaFromRequest('image')
          ->toMediaCollection();
      }

      $event->save();

      session()->flash('success', trans('main.updated'));
      return redirect()->route('events.show', [$event->id]);
    }

    public function destroy($id)
    {
      $redirect = true;
      $event = $this->getById($id);
      $event->clearMediaCollection();
      $event->delete();

      if ($redirect) {
          session()->flash('success', trans('main.deleted-message'));
          return redirect()->route('events.index');
      }
    }


    /**
     * Remove the multible resource from storage.
     *
     * @param  array  $data
     * @return \Illuminate\Http\Response
     */
    public function multi_delete($request)
    {
      if (count($request->selected_data)) {
          foreach ($request->selected_data as $id) {
              $this->destroy($id, false);
          }
          session()->flash('success', trans('main.deleted-message'));
          return redirect()->route('events.index');
      }
    }
}
