<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\LessonInterface;
use App\Http\Traits\LessonTrait;
use App\Models\Lesson;
use App\Models\Course;
use Illuminate\Http\Request;

class LessonRepository implements LessonInterface
{
    private $viewPath = 'backend.lessons';
    use lessonTrait;

    private $lessonModel, $courseModel;

    public function __construct(Lesson $lesson, Course $course)
    {
        $this->lessonModel = $lesson;
        $this->courseModel = $course;
    }

    public function index($dataTable)
    {
        return $dataTable->render("{$this->viewPath}.index", [
          'title' => trans('main.show-all').' '.trans('main.lessons'),
      ]);
    }

    public function create()
    {
      $courses = $this->getAllCourses();

      return view("{$this->viewPath}.create", [
        'title' => trans('main.add').' '.trans('main.lessons'),
        'courses' => $courses,
    ]);
    }

    public function store(array $data)
    {
      if (Lesson::where('course_id', $data['course_id'])->where('myorder', $data['myorder'])->exists()) {
          session()->flash('error', trans('main.ordernumber'));

          return redirect()->back();
      }

       $lesson = Lesson::create($data);

        return $lesson;
    }

    public function show($id)
    {
        $lesson = $this->lessonWithCourse($id);

        return view("{$this->viewPath}.show", [
          'title' => trans('main.show').' '.trans('main.lesson').' : '.$lesson->title,
          'show' => $lesson,
      ]);
    }

    public function edit($id)
    {
        $lesson = $this->getById($id);
        $courses = $this->getAllCourses();

        return view("{$this->viewPath}.edit", [
          'title' => trans('main.edit').' '.trans('main.lesson').' : '.$lesson->title,
          'edit' => $lesson,
          'courses' => $courses,
      ]);
    }

    public function update(array $data, $id)
    {
      $lesson = $this->getById($id);
      if (! $lesson) {
        return back();
      }

      if (Lesson::where('id', '!=', $id)->where('course_id', $data['course_id'])->where('myorder', $data['myorder'])->exists()) {
          session()->flash('error', trans('main.ordernumber'));

          return redirect()->back();
      }

      $lesson->title = $data['title'];
      $lesson->content = $data['content'];
      $lesson->vcontent = $data['vcontent'];
      $lesson->myorder = $data['myorder'];
      $lesson->course_id = $data['course_id'];
      $lesson->active = $data['active'];
      $lesson->save();

      return $lesson;
    }

    public function destroy($id)
    {
        $redirect = true;
        $lesson = $this->getById($id);

        $lesson->delete();

        if ($redirect) {
            return $lesson;
        }
    }

    public function multi_delete($request)
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
