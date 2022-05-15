<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\EventInterface;
use App\Http\Traits\EventTrait;
use App\Models\Country;
use App\Models\Event;
use Illuminate\Http\UploadedFile;

class EventRepository implements EventInterface
{
    private $viewPath = 'backend.events';
    use EventTrait;

    private $eventModel;

    private $countryModel;

    public function __construct(Event $event, Country $country)
    {
        $this->eventModel = $event;
        $this->countryModel = $country;
    }

    public function index($dataTable)
    {
        return $dataTable->render("{$this->viewPath}.index", [
          'title' => trans('main.show-all').' '.trans('main.events'),
      ]);
    }

    public function create()
    {
        $countries = $this->getAllCountries();

        return view("{$this->viewPath}.create", [
          'title' => trans('main.add').' '.trans('main.events'),
          'countries' => $countries,
      ]);
    }

    public function store(array $data)
    {
        $data['description'] = json_encode([
        'en' => $data['description_en'],
        'ar' => $data['description_ar'],
      ]);

        $data['user_id'] = auth()->user()->id;

        $event = Event::create($data);
        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            $event->addMedia($data['image'])->toMediaCollection();
        }

        return $event;
    }

    public function show($id)
    {
        $event = $this->getById($id);

        return view("{$this->viewPath}.show", [
          'title' => trans('main.show').' '.trans('main.event').' : '.$event->title_ar,
          'show' => $event,
      ]);
    }

    public function edit($id)
    {
        $event = $this->getById($id);
        $countries = $this->getAllCountries();

        $event['description_en'] = json_decode($event->description)->en;
        $event['description_ar'] = json_decode($event->description)->ar;

        return view("{$this->viewPath}.edit", [
          'title' => trans('main.edit').' '.trans('main.event').' : '.$event->title,
          'edit' => $event,
          'countries' => $countries,
      ]);
    }

    public function update(array $data, $id)
    {
        $event = $this->getById($id);
        if (! $event) {
            return back();
        }
        $event->title_ar = $data['title_ar'];
        $event->title_en = $data['title_en'];
        $event->country_id = $data['country_id'];
        $event->city = $data['city'];
        $event->location = $data['location'];
        $event->start_date = $data['start_date'];
        $event->end_date = $data['end_date'];
        $event->description = json_encode([
        'en' => $data['description_en'],
        'ar' => $data['description_ar'],
      ]);
        $event->active = $data['active'];
        $event->user_id = auth()->user()->id;

        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            $event->clearMediaCollection();
            $event->addMedia($data['image'])->toMediaCollection();
        }

        $event->save();
        return $event;
    }

    public function destroy($id)
    {
        $redirect = true;
        $event = $this->getById($id);
        $event->clearMediaCollection();
        $event->delete();

        if ($redirect) {
            return $event;
        }
    }

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
