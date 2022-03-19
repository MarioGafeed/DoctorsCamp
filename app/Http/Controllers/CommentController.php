<?php

namespace App\Http\Controllers;
use App\Authorizable;
use App\DataTables\CommentsDataTable;
use App\Http\Interfaces\CommentInterface;
use App\Http\Requests\CommentsRequest;
use Illuminate\Http\Request;


class CommentController extends Controller
{
  use Authorizable;
  private $commentInterface;

  public function __construct(CommentInterface $commentInterface)
  {
      $this->commentInterface = $commentInterface;
  }

  public function index(CommentsDataTable $dataTable)
  {
      return $this->commentInterface->index($dataTable);
  }

  public function create()
  {
      return $this->commentInterface->create();
  }

  public function store(CommentsRequest $request)
  {
      $comment = $this->commentInterface->store($request->all());

      session()->flash('success', trans('main.added-message'));

      return redirect()->route('comments.index');
  }

  public function show($id)
  {
      return $this->commentInterface->show($id);
  }

  public function destroy($id)
  {
      $comment = $this->commentInterface->destroy($id);
      session()->flash('success', trans('main.deleted-message'));

      return redirect()->route('comments.index');
  }

  public function multi_delete(Request $request)
  {
      return $this->commentInterface->multi_delete($request);
  }

  public function toggle($id)
  {
      return $this->commentInterface->toggle($id);
  }
}
