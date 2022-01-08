<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionsRequest extends FormRequest
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
            'lesson_id'  => 'required',
            'q_order'    => 'required',
            'desc'       => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'title'       => trans('main.title'),
            'lesson_id'   => trans('main.lesson'),
            'q_order'     => trans('main.q_order'),
            'desc'        => trans('main.desc'),
        ];
    }
}
