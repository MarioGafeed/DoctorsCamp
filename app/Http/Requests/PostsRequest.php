<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostsRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'title_en'    => 'nullable|string|max:50',
            'title_ar'    => 'required|string|max:50',
            'youtubeURL'  => 'nullable|string|max:244',
            'category_id' => 'required|exists:categories,id',
            'content_en'  => 'nullable',
            'content_ar'  => 'nullable',
            'keyword'     => 'nullable',
            'desc_ar'     => 'nullable',
            'desc_en'     => 'nullable',
            'active'      => 'nullable|in:0,1',
            'type'        => 'nullable|in:article,video',
            'image'       => 'required|image',
            'tags'        => 'nullable',
            'tags.*'      => 'nullable|integer|exists:tags,id',
        ];

        if ($this->method() == 'PATCH') {
            $rules['image'] = 'sometimes|nullable|image';
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'title_ar'    => trans('main.title'),
            'category_id' => trans('main.category'),
            'content'     => trans('main.content'),
            'youtubeURL'  => trans('main.youtubeURL'),
            'type'        => trans('main.type'),
            'keyword'     => trans('main.keyword'),
            'desc'        => trans('main.description'),
            'active'      => trans('main.status'),
        ];
    }
}
