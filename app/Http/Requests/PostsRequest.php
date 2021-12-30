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
          'youtubeURL'       => 'nullable|string|max:244',
          'category_id'      => 'required|exists:categories,id',
          'content_en'       => 'nullable',
          'content_ar'       => 'nullable',
          'keyword'          => 'required',
           'desc_ar'         => 'required',
           'desc_en'         => 'nullable',
           'active'          => 'required|in:0,1',
           'type'            => 'required|in:article,video',
        ];

        // if ($this->method() == 'PATCH') {
        //   $rules['image'] = 'sometimes|nullable|mimes:jpg|dimensions:width=350,height=299';
        // }
        return $rules;
    }


    public function attributes()
    {
        return [
            'title_ar'    => trans('main.title'),
            'category_id' => trans('main.pcategory'),
            'content'     => trans('main.content'),
            'youtubeURL'  => trans('main.youtubeURL'),
            'type'        => trans('main.type'),
            'keyword'     => trans('main.keyword'),
            'desc'        => trans('main.description'),
            'active'      => trans('main.status'),
        ];
    }
}
