<?php

namespace App\Http\Traits;

trait ImageTrait
{
    private function getById($id)
    {
        return $this->imageModel::findOrFail($id);
    }

    private function getAllcategory()
    {
        return $this->catModel::select('id', 'title_en', 'title_ar')->get();
    }

    private function getImageFirst($id)
    {
        return $this->imageModel::where('id', $id)->with('category', 'user')->first();
    }

    private function getImageWithCat($id)
    {
        return $this->imageModel::where('id', $id)->with('category')->first();
    }
}
