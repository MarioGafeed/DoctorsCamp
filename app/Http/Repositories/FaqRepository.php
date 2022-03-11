<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\FaqInterface;
use App\Http\Traits\FaqTrait;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqRepository implements FaqInterface
{
    private $viewPath = 'backend.faqs';
    use FaqTrait;

    private $faqModel;

    public function __construct(Faq $faq)
    {
        $this->faqModel = $faq;
    }

    public function index($dataTable)
    {
        return $dataTable->render("{$this->viewPath}.index", [
          'title' => trans('main.show-all').' '.trans('main.faqs'),
      ]);
    }

    public function create()
    {
        return view("{$this->viewPath}.create", [
          'title' => trans('main.add').' '.trans('main.faqs'),
      ]);
    }

    public function store(array $data)
    {
        $faq = Faq::create($data);

        return $faq;
    }

    public function show($id)
    {
        $faq = $this->getById($id);

        return view("{$this->viewPath}.show", [
          'title' => trans('main.show').' '.trans('main.faq').' : '.$faq->title_en.' : '.$faq->title_ar,
          'show' => $faq,
      ]);
    }

    public function edit($id)
    {
        $faq = $this->getById($id);

        return view("{$this->viewPath}.edit", [
        'title' => trans('main.show').' '.trans('main.faq').' : '.$faq->question,
        'edit' => $faq,
      ]);
    }

    public function update(array $data, $id)
    {
        $faq = $this->getById($id);

        $faq->question = $data['question'];
        $faq->answer = $data['answer'];

        $faq->save();

        return $faq;
    }

    public function destroy($id)
    {
        $redirect = true;

        $faq = $this->getById($id);

        $faq->delete();

        if ($redirect) {
            return $faq;
        }
    }

    public function multi_delete($request)
    {
        if (count($request->selected_data)) {
            foreach ($request->selected_data as $id) {
                $this->destroy($id);
            }
            session()->flash('success', trans('main.deleted-message'));

            return redirect()->route('faqs.index');
        }
    }
}
