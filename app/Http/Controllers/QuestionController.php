<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\QuestionsRequest;
use App\DataTables\QuestionsDataTable;
use App\Models\Question;
use App\Models\Lesson;
use App\Helpers\Helper;
use Spatie\Permission\Models\Role;
use App\Authorizable;


class QuestionController extends Controller
{
  use Authorizable;
  private $viewPath = 'backend.questions';

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(QuestionsDataTable $dataTable)
  {
      return $dataTable->render("{$this->viewPath}.index", [
          'title' => trans('main.show-all') . ' ' . trans('main.questions')
      ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      $les = Lesson::all();
      return view("{$this->viewPath}.create", [
          'title' => trans('main.add') . ' ' . trans('main.questions'),
          'les' => $les,
      ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(QuestionsRequest $request)
  {
      // To Make Sure my order doesn't duplicate..
      $requestAll = $request->all();

      if (Question::where('lesson_id', $request->lesson_id)->where('q_order', $request->q_order)->exists()) {
          session()->flash('error', trans('main.qordernumber'));
          return redirect()->back();
      }

      $requestAll = $request->all();

      $quest = Question::create($requestAll);

      session()->flash('success', trans('main.added-message'));
      return redirect()->route('questions.index');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
      $quest = Question::where('id', $id)->with('lesson')->first();

      return view("{$this->viewPath}.show", [
          'title' => trans('main.show') . ' ' . trans('main.question') . ' : ' . $quest->title,
          'show' => $quest,
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
      $quest = Question::findOrFail($id);
      $les = Lesson::all();
      return view("{$this->viewPath}.edit", [
          'title' => trans('main.edit') . ' ' . trans('main.question') . ' : ' . $quest->name,
          'edit' => $quest,
          'les' => $les,
      ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(QuestionsRequest $request, $id)
  {
      $quest = Question::find($id);

      if ($quest && Question::where('id', '!=', $id)->where('q_order', $request->q_order)->exists()) {
          session()->flash('error', trans('main.qordernumber'));
          return redirect()->back();
      }

      $quest->title = $request->title;
      $quest->q_order  = $request->q_order;
      $quest->lesson_id  = $request->lesson_id;

      $quest->save();

      session()->flash('success', trans('main.updated'));
      return redirect()->route('questions.show', [$quest->id]);
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
      $quest = Question::findOrFail($id);
      $quest->delete();

      if ($redirect) {
          session()->flash('success', trans('main.deleted-message'));
          return redirect()->route('questions.index');
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
          return redirect()->route('questions.index');
      }
  }
}
