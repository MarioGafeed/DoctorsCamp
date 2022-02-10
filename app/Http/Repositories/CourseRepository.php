<?php

namespace App\Http\Repositories;

use App\Authorizable;
use App\Http\Interfaces\CourseInterface;
use App\Http\Traits\CourseTrait;
use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\UploadedFile;

class CourseRepository implements CourseInterface
{
    use CourseTrait;

    private $viewPath = 'backend.courses';

    private $courseModel, $catModel;

    public function __construct(Course $course, Category $cat)
    {
        $this->courseModel = $course;
        $this->catModel = $cat;
    }

    public function index($dataTable)
    {
      return $dataTable->render("{$this->viewPath}.index", [
      'title' => trans('main.show-all').' '.trans('main.courses'),
       ]);
    }

    public function create()
    {
      $categories = Category::Select('id', 'title_en', 'title_ar')->get();

      return view("{$this->viewPath}.create", [
      'title' => trans('main.add').' '.trans('main.courses'),
      'categories'=>$categories
      ]);
    }

    public function store(array $data)
    {
      $data['desc'] = json_encode([
          'en' => $data['desc_en'],
          'ar' => $data['desc_ar'],
      ]);

        $data['user_id'] = auth()->user()->id;

        $course = Course::create($data);

        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            $course->addMedia($data['image'])->toMediaCollection();
        }

        return $course;
    }

    public function show($id)
    {
        $course = $this->getCourseWithCat($id);
        $course['desc_en'] = json_decode($course->desc)->en;
        $course['desc_ar'] = json_decode($course->desc)->ar;

        return view("{$this->viewPath}.show", [
          'title' => trans('main.show').' '.trans('main.course').' : '.$course->name,
          'show' => $course,
      ]);
    }

    public function edit($id)
    {
        $course     = $this->getCourseFirst($id);
        $categories = $this->getAllcategories();

        $course['desc_en'] = json_decode($course->desc)->en;
        $course['desc_ar'] = json_decode($course->desc)->ar;

        return view("{$this->viewPath}.edit", [
          'title' => trans('main.edit').' '.trans('main.course').' : '.$course->name,
          'edit' => $course,
          'categories' => $categories,
      ]);
    }

    public function update(array $data, $id)
    {
        $course = $this->getById($id);
        if (! $course) {
            return back();
        }
        $course->name = $data['name'];
        $course->slug = $data['slug'];
        $course->desc = json_encode([
        'en' => $data['desc_en'],
        'ar' => $data['desc_ar'],
      ]);
        $course->category_id = $data['category_id'];
        $course->slug = $data['slug'];
        $course->active = $data['active'];
        $course->price = $data['price'];

        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            $course->clearMediaCollection();
            $course->addMedia($data['image'])->toMediaCollection();
        }

        $course->save();

        return $course;
    }

    public function destroy($id)
    {
        $redirect = true;
        $course = $this->getById($id);
        $course->clearMediaCollection();
        $course->delete();

        if ($redirect) {
          return $course;
        }
    }

    public function multi_delete($request)
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
