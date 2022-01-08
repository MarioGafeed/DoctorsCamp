<?php

namespace App\Http\Controllers;

use App\Authorizable;
use App\DataTables\AnswersDataTable;
use App\DataTables\UserAnswersDataTable;
use App\Helpers\Helper;
use App\Http\Requests\AnswersRequest;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    use Authorizable;

    private $viewPath = 'backend.answers';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AnswersDataTable $dataTable)
    {
        return $dataTable->render("{$this->viewPath}.index", [
          'title' => trans('main.show-all').' '.trans('main.answers'),
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $quest = Question::all();

        return view("{$this->viewPath}.create", [
          'title' => trans('main.add').' '.trans('main.answers'),
          'quest' => $quest,
      ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnswersRequest $request)
    {
        // To Make Sure my order doesn't duplicate..
        $requestAll = $request->all();

        $ans = Answer::create($requestAll);

        session()->flash('success', trans('main.added-message'));

        return redirect()->route('answers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ans = Answer::where('id', $id)->with('question')->first();

        return view("{$this->viewPath}.show", [
          'title' => trans('main.show').' '.trans('main.answer').' : '.$ans->question->title,
          'show' => $ans,
      ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ans = Answer::findOrFail($id);
        $quest = Question::all();

        return view("{$this->viewPath}.edit", [
          'title' => trans('main.edit').' '.trans('main.answer').' : '.$ans->name,
          'edit' => $ans,
          'quest' => $quest,
      ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AnswersRequest $request, $id)
    {
        $ans = Answer::find($id);

        $ans->answer = $request->answer;
        $ans->status = $request->status;
        $ans->question_id = $request->question_id;

        $ans->save();

        session()->flash('success', trans('main.updated'));

        return redirect()->route('answers.show', [$ans->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param  bool  $redirect
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $redirect = true)
    {
        $ans = Answer::findOrFail($id);
        $ans->delete();

        if ($redirect) {
            session()->flash('success', trans('main.deleted-message'));

            return redirect()->route('answers.index');
        }
    }

    /**
     * Remove the multible resource from storage.
     *
     * @param  array  $data
     * @return \Illuminate\Http\Response
     */
    public function multi_delete(Request $request)
    {
        if (count($request->selected_data)) {
            foreach ($request->selected_data as $id) {
                $this->destroy($id, false);
            }
            session()->flash('success', trans('main.deleted-message'));

            return redirect()->route('answers.index');
        }
    }

    /**
     * user_answers.
     * @param  UserAnswersDataTable $dataTable
     * @return UserAnswersDataTable
     */
    public function user_answers(UserAnswersDataTable $dataTable)
    {
        return $dataTable->render("{$this->viewPath}.index", [
          'title' => trans('main.show-all').' '.trans('main.user').' '.trans('main.answers'),
      ]);
    }
}
