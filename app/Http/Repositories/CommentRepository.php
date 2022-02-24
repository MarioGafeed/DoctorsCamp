<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\CommentInterface;
use App\Models\Comment;
use App\Models\Post;
use App\Http\Traits\CommentTrait;


class CommentRepository implements CommentInterface
{
    use CommentTrait;

    private $viewPath = 'backend.comments';

    private $commentModel, $postModel;

    public function __construct(Comment $comment, Post $post)
    {
        $this->commentModel = $comment;
        $this->postModel = $post;
    }

    public function index($dataTable)
    {
        return $dataTable->render("{$this->viewPath}.index", [
          'title' => trans('main.show-all').' '.trans('main.comments'),
      ]);
    }

    public function create()
    {
        $posts = $this->getAllposts();

        return view("{$this->viewPath}.create", [
          'title' => trans('main.add').' '.trans('main.comments'),
          'posts' => $posts,
      ]);
    }

    public function store(array $data)
    {
        $post    = Post::FindOrFail($data['post_id']);

        $comment = $post->comment($data['comment']);

        return $comment;
    }

    public function show($id)
    {
        $comment = $this->getById($id);

        return view("{$this->viewPath}.show", [
          'title' => trans('main.show').' '.trans('main.comment').' : '.$comment->comment,
          'show' => $comment,
      ]);
    }

    public function destroy($id)
    {
        $redirect = true;
        $comment = $this->getById($id);
        $comment->delete();

        if ($redirect) {
          return $comment;
        }
    }

    public function multi_delete($request)
    {
        if (count($request->selected_data)) {
            foreach ($request->selected_data as $id) {
                $this->destroy($id, false);
            }
            session()->flash('success', trans('main.deleted-message'));

            return redirect()->route('posts.index');
        }
    }

    public function toggle($id)
    {
      $comment = $this->getById($id);

      $comment->update([
        'is_approved' => ! $comment->is_approved
      ]);
      return back();
    }
}
