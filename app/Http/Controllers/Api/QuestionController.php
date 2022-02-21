<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Authorizable;
use App\Http\Interfaces\QuestionInterface;
use App\Models\Question;
use App\Http\Resources\QuestionResource;

class QuestionController extends Controller
{
  use Authorizable;

  public function __construct(private QuestionInterface $questionInterface)
  {
  }

  public function index()
  {
      $questions = Question::with('lesson', 'answers')->paginate(10);

      return QuestionResource::collection($questions);
  }

  public function show(Question $question)
  {
      return new QuestionResource($question);
  }
}
