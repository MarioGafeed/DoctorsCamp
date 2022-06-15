<?php

namespace App\Http\Controllers\Api;

use App\Helpers\JsonResponder;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\PostInterface;
use App\Http\Requests\PostsRequest;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostuserResource;
use App\Http\Resources\PostvideoResource;
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
        ->where('type', 'article')
        ->where('active', 1)
        ->with('user:id,name')
        ->with('category:id,title_en,title_ar')
        ->withCount('comments')
        ->paginate(10);

     return PostResource::collection($posts);
    }


    public function indexvideo(Request $request)
    {
      $posts = Post::when($request->keyword, function ($query) use ($request){
            $query->orWhere('title_ar', 'LIKE', "%$request->keyword%")
            ->orWhere('title_en', 'LIKE', "%$request->keyword%")
            ->orWhere('desc', 'LIKE', "%$request->keyword%")
            ->orWhere('keyword', 'LIKE', "%$request->keyword%")
            // ->orWhere(User::select('name')->get(), 'LIKE', "%$request->keyword%")
            ->get();
      })->whereNotNull('title_ar')
        ->where('type', 'video')
        ->where('active', 1)
        ->with('user:id,name')
        ->with('category:id,title_en,title_ar')
        ->withCount('comments')
        ->paginate(10);

     return PostvideoResource::collection($posts);
    }

    public function indexsound(Request $request)
    {
      $posts = Post::when($request->keyword, function ($query) use ($request){
            $query->orWhere('title_ar', 'LIKE', "%$request->keyword%")
            ->orWhere('title_en', 'LIKE', "%$request->keyword%")
            ->orWhere('desc', 'LIKE', "%$request->keyword%")
            ->orWhere('keyword', 'LIKE', "%$request->keyword%")
            // ->orWhere(User::select('name')->get(), 'LIKE', "%$request->keyword%")
            ->get();
      })->whereNotNull('title_ar')
        ->where('type', 'sound')
        ->where('active', 1)
        ->with('user:id,name')
        ->with('category:id,title_en,title_ar')
        ->withCount('comments')
        ->paginate(10);

     return PostvideoResource::collection($posts);
    }

    public function myposts(Request $request)
    {
      $posts = Post::when($request->keyword, function ($query) use ($request){
            $query->orWhere('title_ar', 'LIKE', "%$request->keyword%")
            ->orWhere('title_en', 'LIKE', "%$request->keyword%")
            ->orWhere('desc', 'LIKE', "%$request->keyword%")
            ->orWhere('keyword', 'LIKE', "%$request->keyword%")
            // ->orWhere(User::select('name')->get(), 'LIKE', "%$request->keyword%")
            ->get();
      })->whereNotNull('title_ar')
        ->where('user_id', $request->user()->id)
        ->with('user:id,name')
        ->with('category:id,title_en,title_ar')
        ->withCount('comments')
        ->paginate(10);

       return PostResource::collection($posts);
    }

    public function store(PostsRequest $request)
    {
        $pos = $this->postInterface->store($request->all());

        return JsonResponder::make(trans('main.postcreate'));

    }

    public function show(Post $post)
    {
        return new PostResource($post);
     }

    public function showvideo(Post $post)
    {
        return new PostvideoResource($post);
    }

    public function update(PostsRequest $request, Post $post)
    {

      if ($post->user_id == $request->user()->id) {
        // $post->update($request->only('post'));
        $post->update($request->all());
        return JsonResponder::make(trans('main.postupdate'));
      }else {
        return 0 ;
      }

    }

    public function destroy(Post $post, Request $request)
    {
      if ($post->user_id == $request->user()->id) {
        $post->delete();
        return JsonResponder::make(trans('main.postdelete'));
      }else {
        return 0 ;
      }
    }

    public function userfavoriteposts(Request $request)
    {
      $user = $request->user();

      $userfavoriteposts = Post::where('type', 'article')->whereLikedBy($user->id)->get();

      return PostuserResource::collection($userfavoriteposts);
    }

    public function userfavoritevideos(Request $request)
    {
      $user = $request->user();

      $userfavoriteposts = Post::where('type', 'video')->whereLikedBy($user->id)->get();

      return PostuserResource::collection($userfavoriteposts);
    }

    public function userfavoritesounds(Request $request)
    {
      $user = $request->user();

      $userfavoriteposts = Post::where('type', 'sound')->whereLikedBy($user->id)->get();

      return PostuserResource::collection($userfavoriteposts);
    }
}
