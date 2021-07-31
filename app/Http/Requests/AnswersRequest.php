<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnswersRequest extends FormRequest
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
            'answer'      => 'required',
            'question_id'  => 'required',
            'status'     => 'required|in:true,false',
        ];
    }


    public function attributes()
    {
        return [
            'answer'       => trans('main.answer'),
            'question_id'   => trans('main.question_id'),
            'status'     => trans('main.status'),
        ];
    }
}
