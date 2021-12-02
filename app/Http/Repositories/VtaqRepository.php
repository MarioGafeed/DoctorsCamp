<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\VtaqInterface;
use App\Http\Traits\VtaqTrait;
use App\Models\Vtaq;
use Illuminate\Http\Request;
use App\Helpers\Helper;


class VtaqRepository implements VtaqInterface
{
    private $viewPath = 'backend.vtaqs';
    use VtaqTrait;
    private $vtaqModel;
    public function __construct(Vtaq $vtaq)
    {
        $this->vtaqModel = $vtaq;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($dataTable)
    {
      return $dataTable->render("{$this->viewPath}.index", [
          'title' => trans('main.show-all') . ' ' . trans('main.vtaqs')
      ]);
    }

    public function create()
    {
      return view("{$this->viewPath}.create", [
          'title' => trans('main.add') . ' ' . trans('main.vtaqs'),
      ]);
    }

    public function store($request)
    {
      $requestAll = $request->all();
      $vtaq = Vtaq::create($requestAll);
      session()->flash('success', trans('main.added-message'));
      return redirect()->route('vtaqs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $vtaq = $this->getById($id);
      return view("{$this->viewPath}.show", [
          'title' => trans('main.show') . ' ' . trans('main.vtaq') . ' : ' . $vtaq->name,
          'show' => $vtaq,
      ]);
    }


    public function edit($id)
    {
      $vtaq = $this->getById($id);
      return view("{$this->viewPath}.edit", [
          'title' => trans('main.edit') . ' ' . trans('main.vtaq') . ' : ' . $vtaq->name,
          'edit' => $vtaq
      ]);
    }

    public function update($request, $id)
    {
      $vtaq = $this->getById($id);
      $vtaq->name = $request->name;
      $vtaq->save();

      session()->flash('success', trans('main.updated'));
      return redirect()->route('vtaqs.show', [$vtaq->id]);
    }

    public function destroy($id)
    {
      $redirect = true;
      $vtaq = $this->getById($id);
      $vtaq->delete();

      if ($redirect) {
          session()->flash('success', trans('main.deleted-message'));
          return redirect()->route('vtaqs.index');
      }
    }


    /**
     * Remove the multible resource from storage.
     *
     * @param  array  $data
     * @return \Illuminate\Http\Response
     */
    public function multi_delete($request)
    {
      if (count($request->selected_data)) {
          foreach ($request->selected_data as $id) {
              $this->destroy($id, false);
          }
          session()->flash('success', trans('main.deleted-message'));
          return redirect()->route('vtaqs.index');
      }
    }
}
