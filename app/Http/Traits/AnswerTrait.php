<?php

namespace App\Http\Traits;

trait AnswerTrait
{
    private function getById($id)
    {
        return $this->answerModel::findOrFail($id);
    }

    private function getAllquestions()
    {
        return $this->questionModel::select('id', 'title')->get();
    }

    private function answerWithQuestion($id)
    {
        return $this->answerModel::where('id', $id)->with('question')->first();
    }
}
