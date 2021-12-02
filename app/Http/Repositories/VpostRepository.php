<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\VpostInterface;
use App\Http\Traits\VpostTrait;
use App\Models\Vpost;
use App\Models\Vcategory;
use App\Models\Vtaq;
use Illuminate\Http\Request;
use App\Helpers\Helper;



class VpostRepository implements VpostInterface
{
    private $viewPath = 'backend.vposts';
    use VpostTrait;
    private $vpostModel;
    private $vcatModel;
    private $vtaqModel;
    public function __construct(Vpost $vpost, Vcategory $vcat, Vtaq $vtaq)
    {
        $this->vpostModel = $vpost;
        $this->vcatModel  = $vcat;
        $this->vtaqModel  = $vtaq;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($dataTable)
    {
      return $dataTable->render("{$this->viewPath}.index", [
          'title' => trans('main.show-all') . ' ' . trans('main.vposts')
      ]);
    }

    public function create()
    {
      $vcat = $this->getAllvcategory();
      $vtaq = $this->getAlltaqs();
      return view("{$this->viewPath}.create", [
          'title' => trans('main.add') . ' ' . trans('main.vposts'),
          'vcat'  => $vcat,
          'vtaq'  => $vtaq,
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
      if ($request->hasFile('image')) {
        $requestAll['image'] = Helper::Upload('vposts', $request->file('image'), 'checkImages');
      }else {
        $requestAll['image'] = "vposts/default.jpg";
      }
      $requestAll['user_id'] = auth()->user()->id;
      $vpos = Vpost::create($requestAll);
    // dd($requestAll['vtaq_id']);

      if ($requestAll['vtaq_id'])
      {
        $vpos->vtaqs()->attach($requestAll['vtaq_id']);
      }

      session()->flash('success', trans('main.added-message'));
      return redirect()->route('vposts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $vpos = $this->getvPostWithvCat($id);
      $vpos['title_en'] = json_decode($vpos->title)->en;
      $vpos['title_ar'] = json_decode($vpos->title)->ar;
      $vpos['desc_en']  = json_decode($vpos->desc)->en;
      $vpos['desc_ar']  = json_decode($vpos->desc)->ar;
      return view("{$this->viewPath}.show", [
          'title' => trans('main.show') . ' ' . trans('main.post') . ' : ' . $vpos->title,
          'show' => $vpos,
      ]);
    }


    public function edit($id)
    {
      $vpos = $this->getVpostFirst($id);
      $vcat = $this->getAllvcategory();
      $vtaq = $this->getAlltaqs();
      $vpos['title_en'] = json_decode($vpos->title)->en;
      $vpos['title_ar'] = json_decode($vpos->title)->ar;
      $vpos['desc_en'] = json_decode($vpos->desc)->en;
      $vpos['desc_ar'] = json_decode($vpos->desc)->ar;
      return view("{$this->viewPath}.edit", [
          'title' => trans('main.edit') . ' ' . trans('main.post') . ' : ' . $vpos->title,
          'edit' => $vpos,
          'vcat' => $vcat,
          'vtaq' => $vtaq,
      ]);
    }

    public function update($request, $id)
    {
      $vpos = $this->getById($id);
      if (!$vpos) {
        return back();
      }
      $vpos->title = json_encode([
        'en' => $request->title_en,
        'ar' => $request->title_ar,
      ]);
      $vpos->desc = json_encode([
        'en' => $request->desc_en,
        'ar' => $request->desc_ar,
      ]);
      $vpos->content  = $request->content;
      $vpos->vcat_id  = $request->vcat_id;
      $vpos->keyword   = $request->keyword;
      $vpos->active = $request->active;
      $vpos->user_id = auth()->user()->id;

      if ($request->hasFile('image')) {
          $vpos->image = Helper::UploadUpdate($vpos->image ?? "", 'vposts', $request->file('image'), 'checkImages');
      }

      $vpos->save();
     if ($request->vtaq_id) {
      $vpos->vtaqs()->sync($request->vtaq_id);
       }
      session()->flash('success', trans('main.updated'));
      return redirect()->route('vposts.show', [$vpos->id]);
    }

    public function destroy($id)
    {
      $redirect = true;
      $vpos = $this->getById($id);
      if (file_exists(public_path('uploads/' . $vpos->image))) {
          @unlink(public_path('uploads/' . $vpos->image));
      }
      $vpos->delete();

      if ($redirect) {
          session()->flash('success', trans('main.deleted-message'));
          return redirect()->route('vposts.index');
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
          return redirect()->route('vposts.index');
      }
    }
}
