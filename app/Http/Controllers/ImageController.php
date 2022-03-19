<?php

namespace App\Http\Controllers;

use App\Authorizable;
use App\DataTables\ImagesDataTable;
use App\Http\Interfaces\ImageInterface;
use App\Http\Requests\ImagesRequest;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    use Authorizable;
    private $imageInterface;

    public function __construct(ImageInterface $imageInterface)
    {
        $this->imageInterface = $imageInterface;
    }

    public function index(ImagesDataTable $dataTable)
    {
        return $this->imageInterface->index($dataTable);
    }

    public function create()
    {
        return $this->imageInterface->create();
    }

    public function store(ImagesRequest $request)
    {
        $image = $this->imageInterface->store($request->all());
        session()->flash('success', trans('main.added-message'));

        return redirect()->route('images.index');
    }

    public function show($id)
    {
        return $this->imageInterface->show($id);
    }

    public function edit($id)
    {
        return $this->imageInterface->edit($id);
    }

    public function update(ImagesRequest $request, $id)
    {
        $image = $this->imageInterface->update($request->all(), $id);
        session()->flash('success', trans('main.updated'));

        return redirect()->route('images.show', [$image->id]);
    }

    public function destroy($id)
    {
        return $this->imageInterface->destroy($id);
    }

    public function multi_delete(Request $request)
    {
        return $this->imageInterface->multi_delete($request);
    }
}
