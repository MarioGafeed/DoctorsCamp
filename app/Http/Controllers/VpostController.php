<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\VpostsRequest;
use App\Http\Interfaces\VpostInterface;
use App\DataTables\VpostsDataTable;
use App\Helpers\Helper;
use App\Authorizable;

class VpostController extends Controller
{
  // use Authorizable;
  private $VpostInterface;
  public function __construct(VpostInterface $VpostInterface)
  {
      $this->VpostInterface = $VpostInterface;
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */

  public function index(VpostsDataTable $dataTable)
  {    
      return $this->VpostInterface->index($dataTable);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      return $this->VpostInterface->create();
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(VpostsRequest $request)
  {
      return $this->VpostInterface->store($request);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
      return $this->VpostInterface->show($id);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
     return $this->VpostInterface->edit($id);
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
     return $this->VpostInterface->update($request, $id);
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
    return $this->VpostInterface->destroy($id);
  }


  /**
   * Remove the multible resource from storage.
   *
   * @param  array  $data
   * @return \Illuminate\Http\Response
   */
  public function multi_delete(Request $request)
  {
      return $this->VpostInterface->multi_delete($request);
  }
}
