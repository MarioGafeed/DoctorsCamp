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

    private $userInterface;

    public function __construct(UserInterface $userInterface)
    {
        $this->userInterface = $userInterface;
    }

    public function index(UsersDataTable $dataTable)
    {
        return $this->userInterface->index($dataTable);
    }

    public function create()
    {
        return $this->userInterface->create();
    }

    public function store(UsersRequest $request)
    {
        $user = $this->userInterface->store($request->all());

        session()->flash('success', trans('main.added-message'));

        return redirect()->route('users.index');
    }

    public function show($id)
    {
        return  $this->userInterface->show($id);
    }

    public function edit($id)
    {
        return $this->userInterface->edit($id);
    }

    public function update(UsersRequest $request, $id)
    {
        $user = $this->userInterface->update($request->all(), $id);
        session()->flash('success', trans('main.updated'));

        return redirect()->route('users.show', [$user->id]);
    }

    public function destroy($id)
    {
        $user = $this->userInterface->destroy($id);
        session()->flash('success', trans('main.deleted-message'));

        return redirect()->route('users.index');
    }

    public function multi_delete(Request $request)
    {
        return $this->userInterface->multi_delete($request);
    }
}
