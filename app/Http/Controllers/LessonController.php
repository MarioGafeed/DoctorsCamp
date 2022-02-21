<?php

namespace App\Http\Controllers;

use App\Authorizable;
use App\DataTables\LessonsDataTable;
use App\Http\Interfaces\LessonInterface;
use App\Http\Requests\LessonsRequest;
use Illuminate\Http\Request;

class LessonController extends Controller
{
  // use Authorizable;
  private $lessonInterface;

  public function __construct(LessonInterface $lessonInterface)
  {
      $this->lessonInterface = $lessonInterface;
  }

  public function index(LessonsDataTable $dataTable)
  {
      return $this->lessonInterface->index($dataTable);
  }

  public function create()
  {
      return $this->lessonInterface->create();
  }

  public function store(LessonsRequest $request)
  {
     $lesson = $this->lessonInterface->store($request->all());

     session()->flash('success', trans('main.added-message'));

     return redirect()->route('lessons.index');
  }

  public function show($id)
  {
     return $this->lessonInterface->show($id);
  }

  public function edit($id)
  {
    return $this->lessonInterface->edit($id);
  }

  public function update(LessonsRequest $request, $id)
  {
      $lesson = $this->lessonInterface->update($request->all(), $id);

      session()->flash('success', trans('main.updated'));

      return redirect()->route('lessons.show', [$lesson->id]);
  }

  public function destroy($id, $redirect = true)
  {
      $lesson = $this->lessonInterface->destroy($id);
      session()->flash('success', trans('main.deleted-message'));

      return redirect()->route('lessons.index');
  }

  public function multi_delete(Request $request)
  {
     return $this->lessonInterface->multi_delete($request);
  }
}
