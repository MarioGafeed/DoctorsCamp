<?php

namespace App\Http\Traits;

trait LessonTrait
{
    private function getById($id)
    {
        return $this->lessonModel::findOrFail($id);
    }

    private function getAllCourses()
    {
        return $this->courseModel::select('id', 'name')->get();
    }

    private function lessonWithCourse($id)
    {
       return $this->lessonModel::where('id', $id)->with('course')->first();
    }
}
