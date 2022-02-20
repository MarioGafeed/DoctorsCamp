<?php

namespace App\Http\Controllers;

use App\Authorizable;
use App\DataTables\AnswersDataTable;
use App\DataTables\UserAnswersDataTable;
use App\Http\Interfaces\AnswerInterface;
use App\Helpers\Helper;
use App\Http\Requests\AnswersRequest;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    use Authorizable;

    private $answerInterface;

    public function __construct(AnswerInterface $answerInterface)
    {
        $this->answerInterface = $answerInterface;
    }

    public function index(AnswersDataTable $dataTable)
    {
        return $this->answerInterface->index($dataTable);
    }

    public function create()
    {
        return $this->answerInterface->create();
    }

    public function store(AnswersRequest $request)
    {
        $answer = $this->answerInterface->store($request->all());

        session()->flash('success', trans('main.added-message'));

        return redirect()->route('answers.index');
    }

    public function show($id)
    {
        return $this->answerInterface->show($id);
    }

    public function edit($id)
    {
       return $this->answerInterface->edit($id);
    }

    public function update(AnswersRequest $request, $id)
    {
        $answer = $this->answerInterface->update($request->all(), $id);

        session()->flash('success', trans('main.updated'));

        return redirect()->route('answers.show', [$answer->id]);
    }

    public function destroy($id)
    {
      $answer = $this->answerInterface->destroy($id);
      session()->flash('success', trans('main.deleted-message'));

      return redirect()->route('answers.index');
    }

    public function multi_delete(Request $request)
    {
        return $this->answerInterface->multi_delete($request);
    }

    public function user_answers(UserAnswersDataTable $dataTable)
    {
        return $dataTable->render("{$this->viewPath}.index", [
          'title' => trans('main.show-all').' '.trans('main.user').' '.trans('main.answers'),
      ]);
    }
}
