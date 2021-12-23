<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\CategoryInterface;
use App\Http\Traits\CategoryTrait;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Helpers\Helper;



class CategoryRepository implements CategoryInterface
{
    private $viewPath = 'backend.categories';
    use CategoryTrait;
    private $categoryModel;
    public function __construct(Category $cat)
    {
        $this->categoryModel = $cat;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($dataTable)
    {
      return $dataTable->render("{$this->viewPath}.index", [
          'title' => trans('main.show-all') . ' ' . trans('main.categories')
      ]);
    }

    public function create()
    {
      return view("{$this->viewPath}.create", [
          'title' => trans('main.add') . ' ' . trans('main.categories'),
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
      $requestAll['summary'] = json_encode([
        'en' => $request->summary_en,
        'ar' => $request->summary_ar,
      ]);

      $cat = Category::create($requestAll);

      if ($request->hasFile('image')) {
        $cat->addMediaFromRequest('image')->toMediaCollection();
      }


      session()->flash('success', trans('main.added-message'));
      return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      // $cat = Pcategory::where('id', $id)->with('class')->first();
      $cat = $this->getById($id);
      $cat['title_en']    = json_decode($cat->title)->en;
      $cat['title_ar']    = json_decode($cat->title)->ar;
      $cat['desc_en']     = json_decode($cat->desc)->en;
      $cat['desc_ar']     = json_decode($cat->desc)->ar;
      $cat['summary_en']  = json_decode($cat->summary)->en;
      $cat['summary_ar']  = json_decode($cat->summary)->ar;

      return view("{$this->viewPath}.show", [
          'title' => trans('main.show') . ' ' . trans('main.category') . ' : ' . $cat->title_en . ' : ' . $cat->title_ar,
          'show' => $cat,
      ]);
    }


    public function edit($id)
    {
      $cat = $this->getById($id);
      $cat['title_en'] = json_decode($cat->title)->en;
      $cat['title_ar'] = json_decode($cat->title)->ar;
      $cat['desc_en'] = json_decode($cat->desc)->en;
      $cat['desc_ar'] = json_decode($cat->desc)->ar;
      $cat['summary_en'] = json_decode($cat->summary)->en;
      $cat['summary_ar'] = json_decode($cat->summary)->ar;
      return view("{$this->viewPath}.edit", [
          'title' => trans('main.edit') . ' ' . trans('main.category') . ' : ' . $cat->title_en . ' : ' . $cat->title_ar,
          'edit' => $cat
      ]);
    }

    public function update($request, $id)
    {
      $cat = Category::find($id);
      $cat->title = json_encode([
        'en' => $request->title_en,
        'ar' => $request->title_ar,
      ]);
      $cat->desc = json_encode([
        'en' => $request->desc_en,
        'ar' => $request->desc_ar,
      ]);
      $cat->summary = json_encode([
        'en' => $request->summary_en,
        'ar' => $request->summary_ar,
      ]);
      $cat->keyword = $request->keyword;

      if ($request->hasFile('image')) {
        $cat->clearMediaCollection();
        $cat
          ->addMediaFromRequest('image')
          ->toMediaCollection();
      }

      $cat->save();

      session()->flash('success', trans('main.updated'));
      return redirect()->route('categories.show', [$cat->id]);
    }

    public function destroy($id)
    {
      $redirect = true;
      $cat = $this->getById($id);
      $cat->clearMediaCollection();
      $cat->delete();

      if ($redirect) {
          session()->flash('success', trans('main.deleted-message'));
          return redirect()->route('categories.index');
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
          return redirect()->route('categories.index');
      }
    }
}
