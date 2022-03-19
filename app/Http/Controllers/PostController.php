<?php

namespace App\Http\Controllers;

use App\Authorizable;
use App\DataTables\PostsDataTable;
use App\Http\Interfaces\PostInterface;
use App\Http\Requests\PostsRequest;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use Authorizable;
    private $postInterface;

    public function __construct(PostInterface $postInterface)
    {
        $this->postInterface = $postInterface;
    }

    public function index(PostsDataTable $dataTable)
    {
        return $this->postInterface->index($dataTable);
    }

    public function create()
    {
        return $this->postInterface->create();
    }

    public function store(PostsRequest $request)
    {
        $pos = $this->postInterface->store($request->all());

        session()->flash('success', trans('main.added-message'));

        return redirect()->route('posts.index');
    }

    public function show($id)
    {
        return $this->postInterface->show($id);
    }

    public function edit($id)
    {
        return $this->postInterface->edit($id);
    }

    public function update(PostsRequest $request, $id)
    {
        $pos = $this->postInterface->update($request->all(), $id);

        session()->flash('success', trans('main.updated'));

        return redirect()->route('posts.show', [$pos->id]);
    }

    public function destroy($id)
    {
        $pos = $this->postInterface->destroy($id);
        session()->flash('success', trans('main.deleted-message'));

        return redirect()->route('posts.index');
    }

    public function multi_delete(Request $request)
    {
        return $this->postInterface->multi_delete($request);
    }
}
