<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriesRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'title_en'        => 'nullable|string|max:50|unique:categories',
            'title_ar'        => 'required|string|max:50|unique:categories',
            'keyword'         => 'nullable',
            'slug'            => 'nullable',
            'summary_en'      => 'nullable',
            'summary_ar'      => 'required',
            'desc_en'         => 'nullable',
            'desc_ar'         => 'required',
            'icon'            => 'required|mimes:icon,png|max:100',
        ];

        if ($this->method() == 'PATCH') {
            $rules['title_en'] = 'sometimes|nullable|string|max:50|unique:categories';
            $rules['title_ar'] = 'sometimes|nullable|string|max:50|unique:categories';
            $rules['icon'] = 'sometimes|mimes:icon,png|max:100';
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'title'         => trans('main.title'),
            'keyword'       => trans('main.keyword'),
            'summary'       => trans('main.summary'),
            'desc'          => trans('main.desc'),
            'icon'          => trans('main.icon'),
        ];
    }
}
