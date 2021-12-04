<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CoursesRequest extends FormRequest
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
        $return = [
            'name'     => 'required',
            'slug'     => 'sometimes|nullable',
            'desc'     => 'required',
            'active'   => 'required|in:0,1',
            'price'    => 'sometimes|nullable|numeric',
        ];


        return $return;
    }


    public function attributes()
    {
        return [
            'name'     => trans('main.name'),
            'slug'     => trans('main.slug'),
            'desc'     => trans('main.desc'),        
            'active'   => trans('main.active'),
            'price'    => trans('main.price'),
        ];
    }
}
