<?php

namespace App\Http\Controllers\Api;

use App\Helpers\JsonResponder;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\PostInterface;
use App\Http\Requests\PostsRequest;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostuserResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function __construct(private PostInterface $postInterface)
    {
    }

    public function index(Request $request)
    {
      $posts = Post::when($request->keyword, function ($query) use ($request){
            $query->orWhere('title_ar', 'LIKE', "%$request->keyword%")
            ->orWhere('title_en', 'LIKE', "%$request->keyword%")
            ->orWhere('desc', 'LIKE', "%$request->keyword%")
            ->orWhere('keyword', 'LIKE', "%$request->keyword%")
            // ->orWhere(User::select('name')->get(), 'LIKE', "%$request->keyword%")
            ->get();
      })->whereNotNull('title_ar')
        ->where('active', 1)
        ->with('user:id,name')
        ->with('category:id,title_en,title_ar')
        ->withCount('comments')
        ->paginate(10);

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

        return JsonResponder::make(trans('main.postdelete'));
    }

    public function userfavoriteposts(Request $request)
    {
      $user = $request->user();

      $userfavoriteposts = Post::whereLikedBy($user->id)->get();

      return PostuserResource::collection($userfavoriteposts);
    }
}
