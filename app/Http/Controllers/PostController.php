<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostsRequest;
use App\Http\Interfaces\PostInterface;
use App\DataTables\PostsDataTable;
use App\Helpers\Helper;
use App\Authorizable;

class PostController extends Controller
{
  // use Authorizable;
  private $PostInterface;
  public function __construct(PostInterface $PostInterface)
  {
      $this->PostInterface = $PostInterface;
  }

   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */



   public function index(PostsDataTable $dataTable)
   {
       return $this->PostInterface->index($dataTable);
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
      return $this->PostInterface->create();
   }



   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(PostsRequest $request)
   {
       return $this->PostInterface->store($request);
   }

   /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function show($id)
   {
       return $this->PostInterface->show($id);
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function edit($id)
   {
       return $this->PostInterface->edit($id);
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function update(PostsRequest $request, $id)
   {
       return $this->PostInterface->update($request, $id);
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
       return $this->PostInterface->destroy($id);
   }


   /**
    * Remove the multible resource from storage.
    *
    * @param  array  $data
    * @return \Illuminate\Http\Response
    */
   public function multi_delete(Request $request)
   {
        return $this->PostInterface->multi_delete($request);
   }
}
