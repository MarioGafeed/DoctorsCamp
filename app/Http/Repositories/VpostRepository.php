<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\VpostInterface;
use App\Http\Traits\VpostTrait;
use App\Models\Vpost;
use App\Models\Vcategory;
use Illuminate\Http\Request;
use App\Helpers\Helper;



class VpostRepository implements VpostInterface
{
    private $viewPath = 'backend.vposts';
    use VpostTrait;
    private $vpostModel;
    private $vcatModel;
    public function __construct(Vpost $vpost, Vcategory $vcat)
    {
        $this->vpostModel = $vpost;
        $this->vcatModel  = $vcat;
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
      return view("{$this->viewPath}.create", [
          'title' => trans('main.add') . ' ' . trans('main.vposts'),
          'vcat'  => $vcat,
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

      $requestAll['user_id'] = auth()->user()->id;
      $vpos = Vpost::create($requestAll);
      if ($request->hasFile('image')) {
        $vpos->addMediaFromRequest('image')->toMediaCollection();
      }

       $tags = explode(',' ,$request->tags);
       $vpos->attachTags($tags);

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

      $tags = $pos->tags->pluck('name')->implode(', ')->toArray();

      $vpos['title_en'] = json_decode($vpos->title)->en;
      $vpos['title_ar'] = json_decode($vpos->title)->ar;
      $vpos['desc_en'] = json_decode($vpos->desc)->en;
      $vpos['desc_ar'] = json_decode($vpos->desc)->ar;
      return view("{$this->viewPath}.edit", [
          'title' => trans('main.edit') . ' ' . trans('main.vpost') . ' : ' . $vpos->title,
          'edit' => $vpos,
          'vcat' => $vcat,
          'tags' => $tags,
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
        $vpos->clearMediaCollection();
        $vpos
          ->addMediaFromRequest('image')
          ->toMediaCollection();
      }

      $vpos->save();
      $tags = explode(',' ,$request->tags);
      $vpos->attachTags($tags);
      session()->flash('success', trans('main.updated'));
      return redirect()->route('vposts.show', [$vpos->id]);
    }

    public function destroy($id)
    {
      $redirect = true;
      $vpos = $this->getById($id);
      $vpos->clearMediaCollection();
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
