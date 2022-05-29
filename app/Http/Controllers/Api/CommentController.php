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

  public function postComments($postId)
  {
     return CommentResource::collection(Comment::where('commentable_id', $postId)->with('user')->orderBy('updated_at', 'desc')->approved()->get());
  }

  public function store(CommentsRequest $request)
  {
      $comment = $this->commentInterface->store($request->all());
      return JsonResponder::make(trans('main.commentcreate'));
  }

  public function update(CommentsRequest $request, Comment $comment)
  {
    if ($comment->user_id == $request->user()->id) {
      $comment->is_approved = 0;
      $comment->update($request->only('comment'));
      return JsonResponder::make(trans('main.commentupdate'));
    }else {
      return 0 ;
    }
  }

  public function destroy(Comment $comment, Request $request)
  {
    if ($comment->user_id == $request->user()->id) {
      $comment->delete();
      return JsonResponder::make(trans('main.commentdelete'));
    }else {
      return 0 ;
    }
  }
}
