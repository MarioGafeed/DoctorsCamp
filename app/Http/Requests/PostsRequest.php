<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class PostsRequest extends FormRequest
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
          'pcat_id'          => 'required|exists:pcategories,id',        
          'content_en'       => 'required',
          'content_ar'       => 'nullable',
          'keyword'          => 'required',
           'desc_ar'         => 'required',
           'desc_en'         => 'nullable',
           'active'          => 'required|in:0,1',
        ];

        // if ($this->method() == 'PATCH') {
        //   $rules['image'] = 'sometimes|nullable|mimes:jpg|dimensions:width=350,height=299';
        // }
        return $rules;
    }


    public function attributes()
    {
        return [
            'title'       => trans('main.title'),
            'pcat_id'   => trans('main.pcategory'),
            'content'     => trans('main.content'),
            'keyword'     => trans('main.keyword'),
            'desc'        => trans('main.description'),
            'active'      => trans('main.status'),
        ];
    }
}
