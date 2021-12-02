<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\PtaqsRequest;
use App\Http\Interfaces\PtaqInterface;
use App\DataTables\PtaqsDataTable;
use App\Helpers\Helper;
use App\Authorizable;

class PtaqController extends Controller
{

  // use Authorizable;
  private $PtaqInterface;
  public function __construct(PtaqInterface $PtaqInterface)
  {
      $this->PtaqInterface = $PtaqInterface;
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(PtaqsDataTable $dataTable)
  {
    return $this->PtaqInterface->index($dataTable);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return $this->PtaqInterface->create();
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(PtaqsRequest $request)
  {
        return $this->PtaqInterface->store($request);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
      return $this->PtaqInterface->show($id);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
      return $this->PtaqInterface->edit($id);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(PtaqsRequest $request, $id)
  {
      return $this->PtaqInterface->update($request, $id);
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
      return $this->PtaqInterface->destroy($id);
  }


  /**
   * Remove the multible resource from storage.
   *
   * @param  array  $data
   * @return \Illuminate\Http\Response
   */
  public function multi_delete(Request $request)
  {
      return $this->PtaqInterface->multi_delete($request);
  }
}
