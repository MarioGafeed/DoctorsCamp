<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\ImageInterface;
use App\Http\Traits\ImageTrait;
use App\Models\Category;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class ImageRepository implements ImageInterface
{
    private $viewPath = 'backend.images';
    use ImageTrait;

    private $imageModel;

    private $catModel;

    public function __construct(Image $image, Category $cat)
    {
        $this->imageModel = $image;
        $this->catModel = $cat;
    }

    public function index($dataTable)
    {
        return $dataTable->render("{$this->viewPath}.index", [
        'title' => trans('main.show-all').' '.trans('main.images'),
    ]);
    }

    public function create()
    {
        $categories = $this->getAllcategory();

        return view("{$this->viewPath}.create", [
        'title' => trans('main.add').' '.trans('main.images'),
        'categories' => $categories,
    ]);
    }

    public function store(array $data)
    {
        $data['user_id'] = auth()->user()->id;

        $image = Image::create($data);
        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            $image->addMedia($data['image'])->toMediaCollection();
        }

      return $image;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $image = $this->getImageWithCat($id);

        return view("{$this->viewPath}.show", [
        'title' => trans('main.show').' '.trans('main.image').' : '.$image->title_ar,
        'show' => $image,
    ]);
    }

    public function edit($id)
    {
        $image = $this->getImageFirst($id);
        $categories = $this->getAllcategory();

        return view("{$this->viewPath}.edit", [
        'title' => trans('main.edit').' '.trans('main.image').' : '.$image->title,
        'edit' => $image,
        'categories' => $categories,
    ]);
    }

    public function update(array $data, $id)
    {
        $image = $this->getById($id);
        if (! $image) {
            return back();
        }
        $image->title_en = $data['title_en'];
        $image->title_ar = $data['title_ar'];
        $image->category_id = $data['category_id'];
        $image->user_id = auth()->user()->id;

        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            $image->clearMediaCollection();
            $image->addMedia($data['image'])->toMediaCollection();
        }

        $image->save();

        return $image;
    }

    public function destroy($id)
    {
        $redirect = true;
        $image = $this->getById($id);
        $image->clearMediaCollection();
        $image->delete();

        if ($redirect) {
            session()->flash('success', trans('main.deleted-message'));

            return redirect()->route('images.index');
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

            return redirect()->route('images.index');
        }
    }
}
