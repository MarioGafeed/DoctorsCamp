<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\CommentInterface;
use App\Http\Requests\CommentsRequest;
use Illuminate\Http\Request;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
// use Illuminate\Http\Response;
use App\Helpers\JsonResponder;

class CommentController extends Controller
{
  public function __construct(private CommentInterface $commentInterface)
  {
  }

  public function index()
  {
     return CommentResource::collection(Comment::with('user')->paginate(10));
  }

  public function store(CommentsRequest $request)
  {
      $comment = $this->commentInterface->store($request->all());

      return JsonResponder::make('Comment Created, Admin will approve Your comment soon..');
  }

  public function update(CommentsRequest $request, Comment $comment)
  {
       $comment->update($request->only('comment'));

       return new CommentResource($comment);
  }

  public function destroy(Comment $comment)
  {
      $comment->delete();

      return JsonResponder::make('Comment deleted');
  }
}
