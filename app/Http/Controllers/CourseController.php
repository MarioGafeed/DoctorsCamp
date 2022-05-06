<?php

namespace App\Http\Controllers;

use App\Authorizable;
use App\DataTables\CoursesDataTable;
use App\Http\Interfaces\CourseInterface;
use App\Helpers\Helper;
use App\Http\Requests\CoursesRequest;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class CourseController extends Controller
{
  use Authorizable;
  private $courseInterface;

  public function __construct(CourseInterface $courseInterface)
  {
      $this->courseInterface = $courseInterface;
  }
    public function index(CoursesDataTable $dataTable)
    {
      return $this->courseInterface->index($dataTable);
    }

    public function create()
    {
        return $this->courseInterface->create();
    }

    public function store(CoursesRequest $request)
    {
        $course = $this->courseInterface->store($request->all());

        session()->flash('success', trans('main.added-message'));

        return redirect()->route('courses.index');
    }

    public function show($id)
    {
        return $this->courseInterface->show($id);
    }

    public function edit($id)
    {
        return $this->courseInterface->edit($id);
    }

    public function update(CoursesRequest $request, $id)
    {
        $course = $this->courseInterface->update($request->all(), $id);

        session()->flash('success', trans('main.updated'));

        return redirect()->route('courses.show', [$course->id]);
    }

    public function destroy($id, $redirect = true)
    {
      $course = $this->courseInterface->destroy($id);
      session()->flash('success', trans('main.deleted-message'));

      return redirect()->route('courses.index');
    }

    public function multi_delete(Request $request)
    {
        return $this->courseInterface->multi_delete($request);
    }
}
