<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\CategoryInterface;
use App\Http\Traits\CategoryTrait;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Illuminate\Http\UploadedFile;

class CategoryRepository implements CategoryInterface
{
    private $viewPath = 'backend.categories';
    use CategoryTrait;

    private $categoryModel;

    public function __construct(Category $cat)
    {
        $this->categoryModel = $cat;
    }

    public function index($dataTable)
    {
        return $dataTable->render("{$this->viewPath}.index", [
          'title' => trans('main.show-all').' '.trans('main.categories'),
      ]);
    }

    public function create()
    {
        return view("{$this->viewPath}.create", [
          'title' => trans('main.add').' '.trans('main.categories'),
      ]);
    }

    public function store(array $data)
    {
        $data['desc'] = json_encode([
        'en' => $data['desc_en'],
        'ar' => $data['desc_ar']
      ]);
        $data['summary'] = json_encode([
        'en' => $data['summary_en'],
        'ar' => $data['summary_ar']
      ]);

      if ($data['icon']) {
         $data['icon'] = Helper::Upload('categories', $data['icon'], 'checkImages');
       }else {
         $data['icon'] = "categories/default.png";
       }

        $cat = Category::create($data);

        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            $cat->addMedia($data['image'])->toMediaCollection();
        }

        return $cat;
    }

    public function show($id)
    {
        $cat = $this->getById($id);

        return view("{$this->viewPath}.show", [
          'title' => trans('main.show').' '.trans('main.category').' : '.$cat->title_en.' : '.$cat->title_ar,
          'show' => $cat,
      ]);
    }

    public function edit($id)
    {
        $cat = $this->getById($id);
        $cat['desc_en'] = json_decode($cat->desc)->en;
        $cat['desc_ar'] = json_decode($cat->desc)->ar;
        $cat['summary_en'] = json_decode($cat->summary)->en;
        $cat['summary_ar'] = json_decode($cat->summary)->ar;

        return view("{$this->viewPath}.edit", [
          'title' => trans('main.edit').' '.trans('main.category').' : '.$cat->title_en.' : '.$cat->title_ar,
          'edit' => $cat,
      ]);
    }

    public function update(array $data, $id)
    {
        $cat = Category::find($id);
        $cat->title_en = $data['title_en'];
        $cat->title_ar = $data['title_ar'];
        $cat->desc = json_encode([
        'en' => $data['desc_en'],
        'ar' => $data['desc_ar']
      ]);
        $cat->summary = json_encode([
        'en' => $data['summary_en'],
        'ar' => $data['summary_ar'],
      ]);
        $cat->keyword = $data['keyword'];

        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            $cat->addMedia($data['image'])->toMediaCollection();
        }

        // if (isset($data['icon'])) {
        //     $cat->icon = Helper::UploadUpdate($cat->icon ?? "", 'categories', isset($data['icon']), 'checkImages');
        // }

        $cat->save();

        return $cat;
    }

    public function destroy($id)
    {
        $redirect = true;
        $cat = $this->getById($id);
        $cat->clearMediaCollection();
        if (file_exists(public_path('uploads/' . $cat->icon))) {
            @unlink(public_path('uploads/' . $cat->icon));
        }
        $cat->delete();

        if ($redirect) {
            return $cat;
        }
    }

    public function multi_delete($request)
    {
        if (count($request->selected_data)) {
            foreach ($request->selected_data as $id) {
                $this->destroy($id);
            }
            session()->flash('success', trans('main.deleted-message'));

            return redirect()->route('categories.index');
        }
    }
}
