<?php

namespace App\Http\Controllers;

use App\Authorizable;
use App\DataTables\UsersDataTable;
use App\Http\Interfaces\UserInterface;
use App\Http\Requests\UsersRequest;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    // use Authorizable;

    private $UserInterface;

    public function __construct(UserInterface $UserInterface)
    {
        $this->UserInterface = $UserInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UsersDataTable $dataTable)
    {
        return $this->UserInterface->index($dataTable);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->UserInterface->create();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        $user = $this->UserInterface->store($request->all());        

        session()->flash('success', trans('main.added-message'));

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return  $this->UserInterface->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->UserInterface->edit($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersRequest $request, $id)
    {
        $user = $this->UserInterface->update($request->all(), $id);
        session()->flash('success', trans('main.updated'));

        return redirect()->route('users.show', [$user->id]);
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
        $user = $this->UserInterface->destroy($id);
        session()->flash('success', trans('main.deleted-message'));

        return redirect()->route('users.index');
    }

    /**
     * Remove the multible resource from storage.
     *
     * @param  array  $data
     * @return \Illuminate\Http\Response
     */
    public function multi_delete(Request $request)
    {
        return $this->UserInterface->multi_delete($request);
    }
}
