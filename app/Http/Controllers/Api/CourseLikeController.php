<?php

namespace App\Http\Controllers\Api;

use App\Models\Course;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CourseLikeController extends Controller
{
    public function action(Request $request, Course $course)
    {
      if ($course->liked()) {
        return $course->unlike();
      }else {
        return $course->like();
      }
    }    
}
