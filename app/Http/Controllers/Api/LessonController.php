<?php

namespace App\Http\Controllers\Api;

use App\Authorizable;
use App\Helpers\JsonResponder;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\LessonInterface;
use App\Http\Requests\LessonsRequest;
use App\Http\Resources\LessonResource;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
  use Authorizable;

  public function __construct(private LessonInterface $lessonInterface)
  {
  }

  public function index()
  {
      $lessons = Lesson::with('course', 'questions')->paginate(10);

      return LessonResource::collection($lessons);
  }

  public function show(Lesson $lesson)
  {
      return new LessonResource($lesson);
  }
}