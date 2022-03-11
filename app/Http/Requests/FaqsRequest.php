<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FaqsRequest extends FormRequest
{
    /**
     * Determine if the categories is authorized to make this request.
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
            'question'        => 'required|string',
            'answer'          => 'required',
        ];

    }

    public function attributes()
    {
        return [
            'question'     => trans('main.question'),
            'answer'       => trans('main.answer'),
        ];
    }
}
