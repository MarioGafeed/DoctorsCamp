<?php

namespace App\Http\Controllers;

use App\Authorizable;
use App\DataTables\LessonsDataTable;
use App\Helpers\Helper;
use App\Http\Requests\LessonsRequest;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class LessonController extends Controller
{
    // use Authorizable;

    private $viewPath = 'backend.lessons';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(LessonsDataTable $dataTable)
    {
        return $dataTable->render("{$this->viewPath}.index", [
          'title' => trans('main.show-all').' '.trans('main.lessons'),
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cor = Course::all();

        return view("{$this->viewPath}.create", [
          'title' => trans('main.add').' '.trans('main.lessons'),
          'cor' => $cor,
      ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LessonsRequest $request)
    {
        // To Make Sure my order doesn't duplicate..
        $requestAll = $request->all();

        if (Lesson::where('course_id', $request->course_id)->where('myorder', $request->myorder)->exists()) {
            session()->flash('error', trans('main.ordernumber'));

            return redirect()->back();
        }
        $requestAll = $request->all();

        $lesson = Lesson::create($requestAll);

        session()->flash('success', trans('main.added-message'));

        return redirect()->route('lessons.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lesson = Lesson::where('id', $id)->with('course')->first();

        return view("{$this->viewPath}.show", [
          'title' => trans('main.show').' '.trans('main.lesson').' : '.$lesson->title,
          'show' => $lesson,
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
        $lesson = Lesson::findOrFail($id);
        $cor = Course::all();

        return view("{$this->viewPath}.edit", [
          'title' => trans('main.edit').' '.trans('main.lesson').' : '.$lesson->title,
          'edit' => $lesson,
          'cor' => $cor,
      ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LessonsRequest $request, $id)
    {
        $lesson = Lesson::find($id);

        if (Lesson::where('id', '!=', $id)->where('course_id', $request->course_id)->where('myorder', $request->myorder)->exists()) {
            session()->flash('error', trans('main.ordernumber'));

            return redirect()->back();
        }

        $lesson->title = $request->title;
        $lesson->content = $request->content;
        $lesson->vcontent = $request->vcontent;
        $lesson->myorder = $request->myorder;
        $lesson->course_id = $request->course_id;
        $lesson->active = $request->active;

        // if ($request->hasFile('image')) {
        //     $lesson->image = Helper::UploadUpdate($lesson->image ?? null, 'lessons', $request->file('image'), 'checkImages');
        // }
        $lesson->save();

        session()->flash('success', trans('main.updated'));

        return redirect()->route('lessons.show', [$lesson->id]);
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
        $lesson = Lesson::findOrFail($id);
        // if (file_exists(public_path('uploads/' . $lesson->image))) {
        //     @unlink(public_path('uploads/' . $lesson->image));
        // }
        $lesson->delete();

        if ($redirect) {
            session()->flash('success', trans('main.deleted-message'));

            return redirect()->route('lessons.index');
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

            return redirect()->route('lessons.index');
        }
    }
}
