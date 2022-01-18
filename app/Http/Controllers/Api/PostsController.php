<?php

namespace App\Http\Controllers\Api;

use App\Authorizable;
use App\Helpers\JsonResponder;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\PostInterface;
use App\Http\Requests\PostsRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    use Authorizable;

    public function __construct(private PostInterface $postInterface)
    {
    }

    public function index()
    {
        $posts = Post::with('media')->paginate(10);

        return PostResource::collection($posts);
    }

    public function store(PostsRequest $request)
    {
        $pos = $this->postInterface->store($request->all());

        return new PostResource($pos);
    }

    public function show(Post $post)
    {
        return new PostResource($post);
    }

    public function update(PostsRequest $request, Post $post)
    {
        return [$request->toArray(), $post->toArray()];
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return JsonResponder::make('Post deleted');
    }
}
