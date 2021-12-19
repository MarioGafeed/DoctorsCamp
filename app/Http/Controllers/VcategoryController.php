<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\VcategoriesRequest;
use App\Http\Interfaces\VcategoryInterface;
use App\DataTables\VcategoriesDataTable;
use App\Helpers\Helper;
use App\Authorizable;

class VcategoryController extends Controller
{
  // use Authorizable;
  private $VcategoryInterface;
  public function __construct(VcategoryInterface $VcategoryInterface)
  {
      $this->VcategoryInterface = $VcategoryInterface;
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(VcategoriesDataTable $dataTable)
  {
      return $this->VcategoryInterface->index($dataTable);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      return $this->VcategoryInterface->create();
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(VcategoriesRequest $request)
  {
      return $this->VcategoryInterface->store($request);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
      return $this->VcategoryInterface->show($id);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
      return $this->VcategoryInterface->edit($id);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(VcategoriesRequest $request, $id)
  {
      return $this->VcategoryInterface->update($request, $id);
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
     return $this->VcategoryInterface->destroy($id);
  }


  /**
   * Remove the multible resource from storage.
   *
   * @param  array  $data
   * @return \Illuminate\Http\Response
   */
  public function multi_delete(Request $request)
  {
      return $this->VcategoryInterface->multi_delete($request);
  }
}
