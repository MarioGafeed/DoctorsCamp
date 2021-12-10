<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\VcategoryInterface;
use App\Http\Traits\VcategoryTrait;
use App\Models\Vcategory;
use Illuminate\Http\Request;
use App\Helpers\Helper;


class VcategoryRepository implements VcategoryInterface
{
    use VcategoryTrait;

    private $viewPath = 'backend.vcategories';

    private $vcategoryModel;
    public function __construct(Vcategory $vcat)
    {
        $this->vcategoryModel = $vcat;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($dataTable)
    {
      return $dataTable->render("{$this->viewPath}.index", [
          'title' => trans('main.show-all') . ' ' . trans('main.vcategories')
      ]);
    }

    public function create()
    {
      return view("{$this->viewPath}.create", [
          'title' => trans('main.add') . ' ' . trans('main.vcategories'),
      ]);
    }

    public function store($request)
    {
      $requestAll = $request->all();
      $requestAll['title'] = json_encode([
        'en' => $request->title_en,
        'ar' => $request->title_ar,
      ]);
      $requestAll['desc'] = json_encode([
        'en' => $request->desc_en,
        'ar' => $request->desc_ar,
      ]);
      $requestAll['summary'] = json_encode([
        'en' => $request->summary_en,
        'ar' => $request->summary_ar,
      ]);

      $vcat = Vcategory::create($requestAll);
      
      if ($request->hasFile('image')) {
        $vcat->addMediaFromRequest('image')->toMediaCollection();
      }



      session()->flash('success', trans('main.added-message'));
      return redirect()->route('vcategories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      // $vcat = Vcategory::where('id', $id)->with('class')->first();
      $vcat = $this->getById($id);
      $vcat['title_en']    = json_decode($vcat->title)->en;
      $vcat['title_ar']    = json_decode($vcat->title)->ar;
      $vcat['desc_en']     = json_decode($vcat->desc)->en;
      $vcat['desc_ar']     = json_decode($vcat->desc)->ar;
      $vcat['summary_en']  = json_decode($vcat->summary)->en;
      $vcat['summary_ar']  = json_decode($vcat->summary)->ar;

      return view("{$this->viewPath}.show", [
          'title' => trans('main.show') . ' ' . trans('main.vcategory') . ' : ' . $vcat->title_en . ' : ' . $vcat->title_ar,
          'show' => $vcat,
      ]);
    }


    public function edit($id)
    {
      $vcat = $this->getById($id);
      $vcat['title_en'] = json_decode($vcat->title)->en;
      $vcat['title_ar'] = json_decode($vcat->title)->ar;
      $vcat['desc_en'] = json_decode($vcat->desc)->en;
      $vcat['desc_ar'] = json_decode($vcat->desc)->ar;
      $vcat['summary_en'] = json_decode($vcat->summary)->en;
      $vcat['summary_ar'] = json_decode($vcat->summary)->ar;
      return view("{$this->viewPath}.edit", [
          'title' => trans('main.edit') . ' ' . trans('main.vcategory') . ' : ' . $vcat->title_en . ' : ' . $vcat->title_ar,
          'edit' => $vcat
      ]);
    }

    public function update($request, $id)
    {
      $vcat = Vcategory::find($id);
      $vcat->title = json_encode([
        'en' => $request->title_en,
        'ar' => $request->title_ar,
      ]);
      $vcat->desc = json_encode([
        'en' => $request->desc_en,
        'ar' => $request->desc_ar,
      ]);
      $vcat->summary = json_encode([
        'en' => $request->summary_en,
        'ar' => $request->summary_ar,
      ]);
      $vcat->keyword = $request->keyword;
      if ($request->hasFile('image')) {
        $vcat->clearMediaCollection();
        $vcat
          ->addMediaFromRequest('image')
          ->toMediaCollection();
      }
      $vcat->save();

      session()->flash('success', trans('main.updated'));
      return redirect()->route('vcategories.show', [$vcat->id]);
    }

    public function destroy($id)
    {
      $redirect = true;
      $vcat = $this->getById($id);
      $vcat->clearMediaCollection();
      $vcat->delete();

      if ($redirect) {
          session()->flash('success', trans('main.deleted-message'));
          return redirect()->route('vcategories.index');
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
          return redirect()->route('vcategories.index');
      }
    }
}
