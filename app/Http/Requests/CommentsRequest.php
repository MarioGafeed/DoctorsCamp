<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
          'comment'     => 'required',
          'post_id'     => 'required|exists:posts,id',
        ];
        if ($this->method() == 'PATCH') {
            $rules['post_id'] = 'sometimes|nullable';
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'comment'    => trans('main.comment'),
            'post_id'    => trans('main.post'),
        ];
    }
}
