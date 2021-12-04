<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\VtaqsRequest;
use App\Http\Interfaces\VtaqInterface;
use App\DataTables\VtaqsDataTable;
use App\Helpers\Helper;
use App\Authorizable;

class VtaqController extends Controller
{
  // use Authorizable;
  private $VtaqInterface;
  public function __construct(VtaqInterface $VtaqInterface)
  {
      $this->VtaqInterface = $VtaqInterface;
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(VtaqsDataTable $dataTable)
  {
      return $this->VtaqInterface->index($dataTable);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      return $this->VtaqInterface->create();
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(VtaqsRequest $request)
  {
      return $this->VtaqInterface->store($request);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
     return $this->VtaqInterface->show($id);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
      return $this->VtaqInterface->edit($id);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(VtaqsRequest $request, $id)
  {
      return $this->VtaqInterface->update($request, $id);
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
    return $this->VtaqInterface->destroy($id);
  }


  /**
   * Remove the multible resource from storage.
   *
   * @param  array  $data
   * @return \Illuminate\Http\Response
   */
  public function multi_delete(Request $request)
  {
      return $this->VtaqInterface->multi_delete($request);
  }
}
