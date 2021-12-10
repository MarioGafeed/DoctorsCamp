<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\PostInterface;
use App\Http\Traits\PostTrait;
use App\Models\Post;
use App\Models\Pcategory;
use App\Models\Ptaq;
use Illuminate\Http\Request;
use App\Helpers\Helper;



class PostRepository implements PostInterface
{
    private $viewPath = 'backend.posts';
    use PostTrait;
    private $postModel;
    private $catModel;
    private $taqModel;
    public function __construct(Post $post, Pcategory $cat, Ptaq $taq)
    {
        $this->postModel = $post;
        $this->catModel  = $cat;
        $this->taqModel  = $taq;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($dataTable)
    {
      return $dataTable->render("{$this->viewPath}.index", [
          'title' => trans('main.show-all') . ' ' . trans('main.posts')
      ]);
    }

    public function create()
    {
      $pcats = $this->getAllpcategory();
      $ptaq  = $this->getAlltaqs();
      return view("{$this->viewPath}.create", [
          'title' => trans('main.add') . ' ' . trans('main.posts'),
          'pcats' => $pcats,
          'ptaq'  => $ptaq,
      ]);
    }

    public function store($request)
    {
      $requestAll = $request->all();
      $requestAll['title'] = json_encode([
        'en' => $request->title_en,
        'ar' => $request->title_ar,
      ]);
      $requestAll['desc'] = json_encode([
        'en' => $request->desc_en,
        'ar' => $request->desc_ar,
      ]);
      $requestAll['content'] = json_encode([
        'en' => $request->content_en,
        'ar' => $request->content_ar,
      ]);


      $requestAll['user_id'] = auth()->user()->id;
      // dd($requestAll);
      $pos = Post::create($requestAll);
      if ($request->hasFile('image')) {
        $pos->addMediaFromRequest('image')->toMediaCollection();
      }
      
      if ($requestAll['ptaq_id'])
      {
        $pos->ptaqs()->attach($requestAll['ptaq_id']);
      }
      session()->flash('success', trans('main.added-message'));
      return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $pos = $this->getPostWithCat($id);
      $pos['title_en'] = json_decode($pos->title)->en;
      $pos['title_ar'] = json_decode($pos->title)->ar;
      $pos['desc_en'] = json_decode($pos->desc)->en;
      $pos['desc_ar'] = json_decode($pos->desc)->ar;
      $pos['content_en'] = json_decode($pos->content)->en;
      $pos['content_ar'] = json_decode($pos->content)->ar;
      return view("{$this->viewPath}.show", [
          'title' => trans('main.show') . ' ' . trans('main.post') . ' : ' . $pos->title,
          'show' => $pos,
      ]);
    }


    public function edit($id)
    {
      $pos = $this->getPostFirst($id);
      $pcats = $this->getAllpcategory();
      $ptaq = $this->getAlltaqs();
      $pos['title_en'] = json_decode($pos->title)->en;
      $pos['title_ar'] = json_decode($pos->title)->ar;
      $pos['desc_en'] = json_decode($pos->desc)->en;
      $pos['desc_ar'] = json_decode($pos->desc)->ar;
      $pos['content_en'] = json_decode($pos->content)->en;
      $pos['content_ar'] = json_decode($pos->content)->ar;
      return view("{$this->viewPath}.edit", [
          'title' => trans('main.edit') . ' ' . trans('main.post') . ' : ' . $pos->title,
          'edit' => $pos,
          'pcats' => $pcats,
          'ptaq' => $ptaq,
      ]);
    }

    public function update($request, $id)
    {
      $pos = $this->getById($id);
      if (!$pos) {
        return back();
      }
      $pos->title = json_encode([
        'en' => $request->title_en,
        'ar' => $request->title_ar,
      ]);
      $pos->desc = json_encode([
        'en' => $request->desc_en,
        'ar' => $request->desc_ar,
      ]);
      $pos->content = json_encode([
        'en' => $request->content_en,
        'ar' => $request->content_ar,
      ]);
      $pos->pcat_id  = $request->pcat_id;
      $pos->keyword   = $request->keyword;
      $pos->active = $request->active;
      $pos->user_id = auth()->user()->id;

      if ($request->hasFile('image')) {
        $pos->clearMediaCollection();
        $pos
          ->addMediaFromRequest('image')
          ->toMediaCollection();
      }


      $pos->save();
     if ($request->ptaq_id) {
      $pos->ptaqs()->sync($request->ptaq_id);
       }
      session()->flash('success', trans('main.updated'));
      return redirect()->route('posts.show', [$pos->id]);
    }

    public function destroy($id)
    {
      $redirect = true;
      $pos = $this->getById($id);
      $pos->clearMediaCollection();
      $pos->delete();

      if ($redirect) {
          session()->flash('success', trans('main.deleted-message'));
          return redirect()->route('posts.index');
      }
    }


    /**
     * Remove the multible resource from storage.
     *
     * @param  array  $data
     * @return \Illuminate\Http\Response
     */
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
