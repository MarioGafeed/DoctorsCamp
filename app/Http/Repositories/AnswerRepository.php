<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\AnswerInterface;
use App\Http\Traits\AnswerTrait;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;

class AnswerRepository implements AnswerInterface
{
      private $viewPath = 'backend.answers';
      use answerTrait;

      private $questionModel, $answerModel;

      public function __construct(Question $question, Answer $answer)
      {
          $this->answerModel = $answer;
          $this->questionModel = $question;
      }

      public function index($dataTable)
      {
          return $dataTable->render("{$this->viewPath}.index", [
            'title' => trans('main.show-all').' '.trans('main.answers'),
        ]);
      }

     public function create()
     {
       $questions = $this->getAllquestions();

       return view("{$this->viewPath}.create", [
         'title' => trans('main.add').' '.trans('main.questions'),
         'questions' => $questions,
      ]);
     }

      public function store(array $data)
      {
         $answer = Answer::create($data);

          return $answer;
      }

      public function show($id)
      {
          $answer = $this->answerWithQuestion($id);

          return view("{$this->viewPath}.show", [
            'title' => trans('main.show').' '.trans('main.answer').' : '.$answer->answer,
            'show' => $answer,
        ]);
      }

      public function edit($id)
      {
          $answer      = $this->getById($id);
          $questions   = $this->getAllquestions();

          return view("{$this->viewPath}.edit", [
            'title' => trans('main.edit').' '.trans('main.answer').' : '.$answer->answer,
            'edit' => $answer,
            'questions' => $questions,
        ]);
      }

      public function update(array $data, $id)
      {
        $answer = $this->getById($id);
        if (! $answer) {
          return back();
        }

        $answer->answer = $data['answer'];
        $answer->status = $data['status'];
        $answer->question_id = $data['question_id'];

        $answer->save();

        return $answer;
      }

      public function destroy($id)
      {
          $redirect = true;
          $answer = $this->getById($id);

          $answer->delete();

          if ($redirect) {
              return $answer;
          }
      }

      public function multi_delete($request)
      {
        if (count($request->selected_data)) {
            foreach ($request->selected_data as $id) {
                $this->destroy($id, false);
            }
            session()->flash('success', trans('main.deleted-message'));

            return redirect()->route('answers.index');
        }
      }
}
