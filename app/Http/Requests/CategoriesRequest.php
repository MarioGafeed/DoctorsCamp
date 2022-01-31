<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriesRequest extends FormRequest
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

        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $return['icon'] = 'nullable|mimes:ico|max:0.5,'.$this->route()->parameter('category').',id';
        return $return;
      }
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
