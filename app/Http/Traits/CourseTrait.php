<?php

namespace App\Http\Traits;

trait CourseTrait
{
    private function getById($id)
    {
        return $this->courseModel::findOrFail($id);
    }

    private function getAllcategories()
    {
        return $this->catModel::select('id', 'title_en', 'title_ar')->get();
    }

    private function getCourseFirst($id)
    {
        return $this->courseModel::where('id', $id)->with('category')->first();
    }

    private function getCourseWithCat($id)
    {
        return $this->courseModel::where('id', $id)->with('category')->first();
    }
}
