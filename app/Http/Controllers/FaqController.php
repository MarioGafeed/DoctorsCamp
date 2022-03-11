<?php

namespace App\Http\Controllers;
use App\Authorizable;
use App\DataTables\FaqsDataTable;
use App\Http\Interfaces\FaqInterface;
use App\Http\Requests\FaqsRequest;
use Illuminate\Http\Request;

class FaqController extends Controller
{
  // use Authorizable;
  private $viewPath = 'backend.faqs';

  private $faqInterface;

  public function __construct(FaqInterface $faqInterface)
  {
      $this->faqInterface = $faqInterface;
  }

  public function index(FaqsDataTable $dataTable)
  {
      return $this->faqInterface->index($dataTable);
  }

  public function create()
  {
      return $this->faqInterface->create();
  }

  public function store(FaqsRequest $request)
  {
      $cat = $this->faqInterface->store($request->all());

      session()->flash('success', trans('main.added-message'));

      return redirect()->route('faqs.index');
  }

  public function show($id)
  {
      return $this->faqInterface->show($id);
  }

  public function edit($id)
  {
      return $this->faqInterface->edit($id);
  }

  public function update(FaqsRequest $request, $id)
  {
      $cat = $this->faqInterface->update($request->all(), $id);
      session()->flash('success', trans('main.updated'));

      return redirect()->route('faqs.show', [$cat->id]);
  }

  public function destroy($id)
  {
      $cat = $this->faqInterface->destroy($id);
      session()->flash('success', trans('main.deleted-message'));

      return redirect()->route('faqs.index');
  }

  public function multi_delete(Request $request)
  {
      return $this->multi_delete($request);
  }
}
