<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\PtaqInterface;
use App\Http\Traits\PtaqTrait;
use App\Models\Ptaq;
use Illuminate\Http\Request;
use App\Helpers\Helper;


class PtaqRepository implements PtaqInterface
{
    private $viewPath = 'backend.ptaqs';
    use PtaqTrait;
    private $ptaqModel;
    public function __construct(Ptaq $ptaq)
    {
        $this->ptaqModel = $ptaq;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($dataTable)
    {
      return $dataTable->render("{$this->viewPath}.index", [
          'title' => trans('main.show-all') . ' ' . trans('main.ptaqs')
      ]);
    }

    public function create()
    {
      return view("{$this->viewPath}.create", [
          'title' => trans('main.add') . ' ' . trans('main.ptaqs'),
      ]);
    }

    public function store($request)
    {
      $requestAll = $request->all();
      $ptaq = Ptaq::create($requestAll);

      session()->flash('success', trans('main.added-message'));
      return redirect()->route('ptaqs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $ptaq = $this->getById($id);
      return view("{$this->viewPath}.show", [
          'title' => trans('main.show') . ' ' . trans('main.ptaq') . ' : ' . $ptaq->name,
          'show' => $ptaq,
      ]);
    }


    public function edit($id)
    {
      $ptaq = $this->getById($id);
      return view("{$this->viewPath}.edit", [
          'title' => trans('main.edit') . ' ' . trans('main.ptaq') . ' : ' . $ptaq->name,
          'edit' => $ptaq
      ]);
    }

    public function update($request, $id)
    {
      $ptaq = $this->getById($id);
      $ptaq->name = $request->name;
      $ptaq->save();

      session()->flash('success', trans('main.updated'));
      return redirect()->route('ptaqs.show', [$ptaq->id]);
    }

    public function destroy($id)
    {
      $redirect = true;
      $ptaq = $this->getById($id);
      $ptaq->delete();

      if ($redirect) {
          session()->flash('success', trans('main.deleted-message'));
          return redirect()->route('ptaqs.index');
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
          return redirect()->route('ptaqs.index');
      }
    }
}
