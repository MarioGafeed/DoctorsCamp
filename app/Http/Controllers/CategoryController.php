<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Interfaces\CategoryInterface;
use App\Http\Requests\CategoriesRequest;
use App\DataTables\CategoriesDataTable;
use App\Authorizable;

class CategoryController extends Controller
{
  // use Authorizable;
  private $CategoryInterface;
  public function __construct(CategoryInterface $CategoryInterface)
  {
      $this->CategoryInterface = $CategoryInterface;
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(CategoriesDataTable $dataTable)
  {
      return $this->CategoryInterface->index($dataTable);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      return $this->CategoryInterface->create();
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(CategoriesRequest $request)
  {
      return $this->CategoryInterface->store($request);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    return $this->CategoryInterface->show($id);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    return $this->CategoryInterface->edit($id);
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
      return $this->CategoryInterface->update($request, $id);
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
      return $this->CategoryInterface->destroy($id);
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
