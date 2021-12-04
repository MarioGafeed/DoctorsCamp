<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LessonsRequest extends FormRequest
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
            'title'      => 'required',
            'course_id'  => 'required',
            'content'    => 'required',
            'vcontent'    => 'required',
            'myorder'    => 'required|integer',
            'active'     => 'required|in:0,1',
        ];
    }


    public function attributes()
    {
        return [
            'title'       => trans('main.title'),
            'course_id'   => trans('main.course'),
            'content'     => trans('main.content'),
            'vcontent'    => trans('main.vcontent'),
            'myorder'     => trans('main.myorder'),
            'active'      => trans('main.active'),            
        ];
    }
}
