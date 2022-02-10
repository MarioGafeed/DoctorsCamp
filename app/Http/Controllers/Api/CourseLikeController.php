<?php

namespace App\Http\Controllers\Api;

use App\Models\Course;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CourseLikeController extends Controller
{
    public function store(Request $request, Course $course)
    {
    return $course->like();
    }

    public function destroy(Course $course)
    {
      if ($course->liked()) {
        return $course->unlike();
      }
    }
}
