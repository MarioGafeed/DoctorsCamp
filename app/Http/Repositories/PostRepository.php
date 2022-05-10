<?php

namespace App\Http\Repositories;

use App\Authorizable;
use App\Http\Interfaces\PostInterface;
use App\Http\Traits\PostTrait;
use App\Models\Category;
use App\Models\Post;
use App\Models\user;
use App\Notifications\PostAddedNotification;
use Illuminate\Http\UploadedFile;

class PostRepository implements PostInterface
{
    use PostTrait;

    private $viewPath = 'backend.posts';

    private $postModel, $catModel;

    public function __construct(Post $post, Category $cat)
    {
        $this->postModel = $post;
        $this->catModel = $cat;
    }

    public function index($dataTable)
    {
        return $dataTable->render("{$this->viewPath}.index", [
          'title' => trans('main.show-all').' '.trans('main.posts'),
      ]);
    }

    public function create()
    {
        $cats = $this->getAllcategory();

        return view("{$this->viewPath}.create", [
          'title' => trans('main.add').' '.trans('main.posts'),
          'cats' => $cats,
      ]);
    }

    public function store(array $data)
    {
        $data['content'] = json_encode([
            'en' => $data['content_en'],
            'ar' => $data['content_ar'],
        ]);

        $data['user_id'] = auth()->user()->id;

        $pos = Post::create($data);

        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            $pos->addMedia($data['image'])->toMediaCollection();
        }

        $tags = $data['tags'] ?? [];

        if (! is_array($tags)) {
            $tags = explode(',', $tags);
        }

        $pos->attachTags($tags);

        $pos->fresh();

        // User::where()->each(function($user) use($pos){
        //     $user->notify(new PostAddedNotification($pos));
        // });

        User::each(fn ($user) => $user->notify(new PostAddedNotification($pos)) );

        return $pos;
    }

    public function show($id)
    {
        $pos = $this->getPostWithCat($id);

        if ($pos['desc_en'] != null) {
          $pos['desc_en'] = json_decode($pos->desc)->en;
        }
        if ($pos['desc_ar'] != null ) {
          $pos['desc_ar'] = json_decode($pos->desc)->ar;
        }
        if ( $pos['content_en'] != null ) {
          $pos['content_en'] = json_decode($pos->content)->en;
        }
        if ( $pos['content_ar'] != null ) {
          $pos['content_ar'] = json_decode($pos->content)->ar;
        }

        return view("{$this->viewPath}.show", [
          'title' => trans('main.show').' '.trans('main.post').' : '.$pos->title_ar,
          'show' => $pos,
      ]);
    }

    public function edit($id)
    {
        $pos = $this->getPostFirst($id);
        $cats = $this->getAllcategory();
        $tags = $pos->tags->pluck('name')->implode(', ');

        if ($pos['desc_en'] != null) {
          $pos['desc_en'] = json_decode($pos->desc)->en;
        }
        if ($pos['desc_ar']) {
          $pos['desc_ar'] = json_decode($pos->desc)->ar;
        }
        if ($pos['content_en']) {
          $pos['content_en'] = json_decode($pos->content)->en;
        }
        if ($pos['content_ar']) {
          $pos['content_ar'] = json_decode($pos->content)->ar;
        }

        return view("{$this->viewPath}.edit", [
          'title' => trans('main.edit').' '.trans('main.post').' : '.$pos->title,
          'edit' => $pos,
          'cats' => $cats,
          'tags' => $tags,
      ]);
    }

    public function update(array $data, $id)
    {
        $pos = $this->getById($id);
        if (! $pos) {
            return back();
        }
        $pos->title_en = $data['title_en'];
        $pos->title_ar= $data['title_ar'];
        $pos->type = $data['type'];
        $pos->youtubeURL = $data['youtubeURL'];
        $pos->desc = json_encode([
        'en' => $data['desc_en'],
        'ar' => $data['desc_ar'],
      ]);
        $pos->content = json_encode([
        'en' => $data['content_en'],
        'ar' => $data['content_ar'],
      ]);
        $pos->category_id = $data['category_id'];
        $pos->keyword = $data['keyword'];
        $pos->active = $data['active'];
        $pos->user_id = auth()->user()->id;

        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            $pos->clearMediaCollection();
            $pos->addMedia($data['image'])->toMediaCollection();
        }

        $pos->save();

        $tags = $data['tags'] ?? [];

        if (! is_array($tags)) {
            $tags = explode(',', $tags);
        }

        $pos->syncTags($tags);

        return $pos;

    }

    public function destroy($id)
    {
        $redirect = true;
        $pos = $this->getById($id);
        $pos->clearMediaCollection();
        $pos->delete();

        if ($redirect) {
          return $pos;
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
}
