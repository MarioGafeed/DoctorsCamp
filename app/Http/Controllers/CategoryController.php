<?php

namespace App\Http\Controllers;

use App\Authorizable;
use App\DataTables\CategoriesDataTable;
use App\Http\Interfaces\CategoryInterface;
use App\Http\Requests\CategoriesRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use Authorizable;
    private $viewPath = 'backend.categories';

    private $categoryInterface;

    public function __construct(CategoryInterface $categoryInterface)
    {
        $this->categoryInterface = $categoryInterface;
    }

    public function index(CategoriesDataTable $dataTable)
    {
        return $this->categoryInterface->index($dataTable);
    }

    public function create()
    {
        return $this->categoryInterface->create();
    }

    public function store(CategoriesRequest $request)
    {
        $cat = $this->categoryInterface->store($request->all());

        session()->flash('success', trans('main.added-message'));

        return redirect()->route('categories.index');
    }

    public function show($id)
    {
        return $this->categoryInterface->show($id);
    }

    public function edit($id)
    {
        return $this->categoryInterface->edit($id);
    }

    public function update(CategoriesRequest $request, $id)
    {
        $cat = $this->categoryInterface->update($request->all(), $id);
        session()->flash('success', trans('main.updated'));

        return redirect()->route('categories.show', [$cat->id]);
    }

    public function destroy($id)
    {
        $cat = $this->categoryInterface->destroy($id);
        session()->flash('success', trans('main.deleted-message'));

        return redirect()->route('categories.index');
    }

    public function multi_delete(Request $request)
    {
        return $this->multi_delete($request);
    }
}
