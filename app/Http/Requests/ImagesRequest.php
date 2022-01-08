<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImagesRequest extends FormRequest
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
        $rules = [
          'title_en'         => 'nullable|string|max:50',
          'title_ar'         => 'required|string|max:50',
          'category_id'      => 'required|exists:categories,id',
        ];

        return $rules;
    }

    public function attributes()
    {
        return [
            'title_ar'    => trans('main.title'),
            'category_id' => trans('main.category'),
        ];
    }
}
