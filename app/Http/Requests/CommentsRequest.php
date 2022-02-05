<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentsRequest extends FormRequest
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
          'comment'     => 'required',
          'post_id'     => 'required|exists:posts,id',
          // 'image_id'     => 'required|exists:posts,id',
          // 'event_id'     => 'required|exists:posts,id',
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
