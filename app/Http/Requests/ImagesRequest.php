<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImagesRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
          'title_en'         => 'nullable|string|max:50',
          'title_ar'         => 'required|string|max:50',
          'category_id'      => 'required|exists:categories,id',
          'desc_ar'          => 'nullable',
          'desc_en'          => 'nullable',
        ];

        return $rules;
    }

    public function attributes()
    {
        return [
            'title_ar'    => trans('main.title'),
            'category_id' => trans('main.category'),
            'desc'        => trans('main.description'),
        ];
    }
}
