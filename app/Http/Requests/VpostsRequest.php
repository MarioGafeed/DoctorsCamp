<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class VpostsRequest extends FormRequest
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
            'title_en'      => 'required',
            'title_ar'      => 'nullable',
            'category_id'   => 'required|exists:categories,id',
            'content'       => 'required',
            'keyword'       => 'required',
            'desc_en'       => 'required',
            'desc_ar'       => 'nullable',
            'active'        => 'required|in:0,1',
        ];
    }


    public function attributes()
    {
        return [
            'title'       => trans('main.title'),
            'category_id' => trans('main.category'),
            'content'     => trans('main.content'),
            'keyword'     => trans('main.keyword'),
            'desc'        => trans('main.description'),
            'active'      => trans('main.status'),
        ];
    }
}
