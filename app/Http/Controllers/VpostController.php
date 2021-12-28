<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\VpostsRequest;
use App\Http\Interfaces\vpostInterface;
use App\DataTables\VpostsDataTable;
use App\Helpers\Helper;
use App\Authorizable;

class VpostController extends Controller
{
  // use Authorizable;
  private $vpostInterface;
  public function __construct(vpostInterface $vpostInterface)
  {
      $this->vpostInterface = $vpostInterface;
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */

  public function index(VpostsDataTable $dataTable)
  {
      return $this->vpostInterface->index($dataTable);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      return $this->vpostInterface->create();
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(VpostsRequest $request)
  {
      return $this->vpostInterface->store($request);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
      return $this->vpostInterface->show($id);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
     return $this->vpostInterface->edit($id);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(VpostsRequest $request, $id)
  {
     return $this->vpostInterface->update($request, $id);
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
    return $this->vpostInterface->destroy($id);
  }


  /**
   * Remove the multible resource from storage.
   *
   * @param  array  $data
   * @return \Illuminate\Http\Response
   */
  public function multi_delete(Request $request)
  {
      return $this->vpostInterface->multi_delete($request);
  }
}
