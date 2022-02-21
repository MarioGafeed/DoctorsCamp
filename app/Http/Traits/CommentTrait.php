<?php

namespace App\Http\Traits;

trait CommentTrait
{
    private function getById($id)
    {
        return $this->commentModel::findOrFail($id);
    }

    private function getAllposts()
    {
        return $this->postModel::select('id', 'title_en', 'title_ar')->get();
    }  
}
