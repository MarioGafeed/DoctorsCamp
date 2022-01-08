<?php

namespace App\Http\Controllers;

use App\Authorizable;
use App\DataTables\ImagesDataTable;
use App\Http\Interfaces\imageInterface;
use App\Http\Requests\ImagesRequest;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    // use Authorizable;
    private $imageInterface;

    public function __construct(imageInterface $imageInterface)
    {
        $this->imageInterface = $imageInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ImagesDataTable $dataTable)
    {
        return $this->imageInterface->index($dataTable);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->imageInterface->create();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ImagesRequest $request)
    {
        return $this->imageInterface->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->imageInterface->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->imageInterface->edit($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ImagesRequest $request, $id)
    {
        return $this->imageInterface->update($request, $id);
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
        return $this->imageInterface->destroy($id);
    }

    /**
     * Remove the multible resource from storage.
     *
     * @param  array  $data
     * @return \Illuminate\Http\Response
     */
    public function multi_delete(Request $request)
    {
        return $this->imageInterface->multi_delete($request);
    }
}
