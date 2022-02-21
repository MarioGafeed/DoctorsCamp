<?php

namespace App\Http\Controllers;

use App\Authorizable;
use App\DataTables\QuestionsDataTable;
use App\Helpers\Helper;
use App\Http\Requests\QuestionsRequest;
use App\Http\Interfaces\QuestionInterface;
use App\Models\Lesson;
use App\Models\Question;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class QuestionController extends Controller
{
    // use Authorizable;
    private $questionInterface;

    public function __construct(QuestionInterface $questionInterface)
    {
        $this->questionInterface = $questionInterface;
    }

    public function index(QuestionsDataTable $dataTable)
    {
      return $this->questionInterface->index($dataTable);
    }

    public function create()
    {
        return $this->questionInterface->create();
    }

    public function store(QuestionsRequest $request)
    {
        $question = $this->questionInterface->store($request->all());

        session()->flash('success', trans('main.added-message'));

        return redirect()->route('questions.index');
    }

    public function show($id)
    {
        return $this->questionInterface->show($id);
    }

    public function edit($id)
    {
        return $this->questionInterface->edit($id);
    }

    public function update(QuestionsRequest $request, $id)
    {
        $question = $this->questionInterface->update($request->all(), $id);

        session()->flash('success', trans('main.updated'));

        return redirect()->route('questions.show', [$question->id]);
    }

    public function destroy($id)
    {
      $question = $this->questionInterface->destroy($id);
      session()->flash('success', trans('main.deleted-message'));

      return redirect()->route('questions.index');
    }

    public function multi_delete(Request $request)
    {
        if (count($request->selected_data)) {
            foreach ($request->selected_data as $id) {
                $this->destroy($id, false);
            }
            session()->flash('success', trans('main.deleted-message'));

            return redirect()->route('questions.index');
        }
    }
}
