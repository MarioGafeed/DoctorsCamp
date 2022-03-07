<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\QuestionInterface;
use App\Http\Traits\QuestionTrait;
use App\Models\Question;
use App\Models\Lesson;
use Illuminate\Http\Request;

class QuestionRepository implements QuestionInterface
{
    private $viewPath = 'backend.questions';
    use questionTrait;

    private $lessonModel, $questionModel;

    public function __construct(Question $question, Lesson $lesson)
    {
        $this->lessonModel = $lesson;
        $this->questionModel = $question;
    }

    public function index($dataTable)
    {
        return $dataTable->render("{$this->viewPath}.index", [
          'title' => trans('main.show-all').' '.trans('main.questions'),
      ]);
    }

    public function create()
    {
      $lessons = $this->getAllLessons();

      return view("{$this->viewPath}.create", [
        'title' => trans('main.add').' '.trans('main.lessons'),
        'lessons' => $lessons,
    ]);
    }

    public function store(array $data)
    {
      if (Question::where('lesson_id', $data['lesson_id'])->where('q_order', $data['q_order'])->exists()) {
          session()->flash('error', trans('main.qordernumber'));

          return redirect()->back();
      }

       $question = Question::create($data);

        return $question;
    }

    public function show($id)
    {
        $question = $this->questionWithLesson($id);

        return view("{$this->viewPath}.show", [
          'title' => trans('main.show').' '.trans('main.question').' : '.$question->title,
          'show' => $question,
      ]);
    }

    public function edit($id)
    {
        $question = $this->getById($id);
        $lessons   = $this->getAllLessons();

        return view("{$this->viewPath}.edit", [
          'title' => trans('main.edit').' '.trans('main.lesson').' : '.$question->title,
          'edit' => $question,
          'lessons' => $lessons,
      ]);
    }

    public function update(array $data, $id)
    {
      $question = $this->getById($id);
      if (! $question) {
        return back();
      }

      if (Question::where('id', '!=', $id)->where('lesson_id', $data['lesson_id'])->where('q_order', $data['q_order'])->exists()) {
          session()->flash('error', trans('main.qordernumber'));

          return redirect()->back();
      }

      $question->title = $data['title'];
      $question->desc = $data['desc'];
      $question->q_order = $data['q_order'];
      $question->lesson_id = $data['lesson_id'];
      $question->op1 = $data['op1'];
      $question->op2 = $data['op2'];
      $question->op3 = $data['op3'];
      $question->op4 = $data['op1'];
      $question->right_ans = $data['right_ans'];

      $question->save();

      return $question;
    }

    public function destroy($id)
    {
        $redirect = true;
        $question = $this->getById($id);

        $question->delete();

        if ($redirect) {
            return $question;
        }
    }

    public function multi_delete($request)
    {
      if (count($request->selected_data)) {
          foreach ($request->selected_data as $id) {
              $this->destroy($id, false);
          }
          session()->flash('success', trans('main.deleted-message'));

          return redirect()->route('question.index');
      }
    }
}
