<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostsRequest;
use App\Http\Interfaces\postInterface;
use App\DataTables\PostsDataTable;
use App\Authorizable;

class PostController extends Controller
{
  // use Authorizable;
  private $postInterface;
  public function __construct(postInterface $postInterface)
  {
      $this->postInterface = $postInterface;
  }

   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */



   public function index(PostsDataTable $dataTable)
   {
       return $this->postInterface->index($dataTable);
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
      return $this->postInterface->create();
   }



   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(PostsRequest $request)
   {
       return $this->postInterface->store($request);
   }

   /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function show($id)
   {
       return $this->postInterface->show($id);
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function edit($id)
   {
       return $this->postInterface->edit($id);
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
       return $this->postInterface->update($request, $id);
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
       return $this->postInterface->destroy($id);
   }


   /**
    * Remove the multible resource from storage.
    *
    * @param  array  $data
    * @return \Illuminate\Http\Response
    */
   public function multi_delete(Request $request)
   {
        return $this->postInterface->multi_delete($request);
   }
}
