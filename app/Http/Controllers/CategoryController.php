<?php

namespace App\Http\Controllers;

use App\Authorizable;
use App\DataTables\CategoriesDataTable;
use App\Http\Interfaces\CategoryInterface;
use App\Http\Requests\CategoriesRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // use Authorizable;
    private $viewPath = 'backend.categories';

    private $categoryInterface;

    public function __construct(CategoryInterface $categoryInterface)
    {
        $this->categoryInterface = $categoryInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CategoriesDataTable $dataTable)
    {
        return $this->categoryInterface->index($dataTable);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->categoryInterface->create();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriesRequest $request)
    {
        $cat = $this->categoryInterface->store($request->all());

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
        return $this->categoryInterface->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->categoryInterface->edit($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoriesRequest $request, $id)
    {
        $cat = $this->categoryInterface->update($request->all(), $id);
        session()->flash('success', trans('main.updated'));

        return redirect()->route('categories.show', [$cat->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param  bool  $redirect
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat = $this->categoryInterface->destroy($id);
        session()->flash('success', trans('main.deleted-message'));

        return redirect()->route('categories.index');
    }

    /**
     * Remove the multible resource from storage.
     *
     * @param  array  $data
     * @return \Illuminate\Http\Response
     */
    public function multi_delete(Request $request)
    {
        return $this->multi_delete($request);
    }
}
