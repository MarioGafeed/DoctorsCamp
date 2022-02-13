<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'title_en'         => 'nullable|string|max:50',
          'title_ar'         => 'required|string|max:50',
          'country_id'       => 'required|exists:countries,id',
          'location'         => 'required|string|max:244',
           'description_ar'  => 'required',
           'description_ar'  => 'nullable',
           'active'          => 'required|in:0,1',
           'start_date'      => 'required',
           'end_date'        => 'required',
         ];
        return $rules;
    }

    public function attributes()
    {
        return [
            'title_ar'           => trans('main.eventTitle'),
            'country_id'         => trans('main.country'),
            'location'           => trans('main.location'),
            'start_date'         => trans('main.start_date'),
            'end_date'           => trans('main.end_date'),
            'description-ar'     => trans('main.description'),
            'active'             => trans('main.status'),
        ];
    }
}
