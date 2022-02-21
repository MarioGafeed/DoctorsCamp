<?php

namespace App\Http\Traits;

trait QuestionTrait
{
    private function getById($id)
    {
        return $this->questionModel::findOrFail($id);
    }

    private function getAllLessons()
    {
        return $this->lessonModel::select('id', 'title')->get();
    }

    private function questionWithLesson($id)
    {
        return $this->questionModel::where('id', $id)->with('lesson')->first();
    }
}
