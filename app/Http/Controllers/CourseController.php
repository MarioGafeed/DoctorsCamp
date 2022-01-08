<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\CoursesRequest;
use App\DataTables\CoursesDataTable;
use App\Models\Course;
use Spatie\Permission\Models\Role;
use App\Helpers\Helper;
use App\Authorizable;

class CourseController extends Controller
{
  // use Authorizable;
  private $viewPath = 'backend.courses';

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(CoursesDataTable $dataTable)
  {
      return $dataTable->render("{$this->viewPath}.index", [
        'title' => trans('main.show-all') . ' ' . trans('main.courses')
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      return view("{$this->viewPath}.create", [
        'title' => trans('main.add') . ' ' . trans('main.courses'),
    ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(CoursesRequest $request)
  {
      $requestAll = $request->all();
      $course =  Course::create($requestAll);

      session()->flash('success', trans('main.added-message'));
      return redirect()->route('courses.index');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
      $course = Course::findOrFail($id);
      return view("{$this->viewPath}.show", [
        'title' => trans('main.show') . ' ' . trans('main.course') . ' : ' . $course->name,
        'show' => $course,
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
      $course = Course::findOrFail($id);
      return view("{$this->viewPath}.edit", [
        'title' => trans('main.edit') . ' ' . trans('main.course') . ' : ' . $course->name,
        'edit' => $course,
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(CoursesRequest $request, $id)
  {
      $course = Course::find($id);
      $course->name   = $request->name;
      $course->slug   = $request->slug;
      $course->desc   = $request->desc;
      $course->price  = $request->price;
      $course->active = $request->active;
      // if ($request->hasFile('image')) {
      //     $course->image = Helper::UploadUpdate($course->image ?? "", 'users', $request->file('image'), 'checkImages');
      // }
      $course->save();

      session()->flash('success', trans('main.updated'));
      return redirect()->route('courses.show', [$course->id]);
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
      $course = Course::findOrFail($id);

      $course->delete();

      if ($redirect) {
          session()->flash('success', trans('main.deleted-message'));
          return redirect()->route('courses.index');
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
          return redirect()->route('courses.index');
      }
  }
}
