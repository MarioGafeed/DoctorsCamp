<?php
namespace App\Http\Traits;

trait PostTrait
{
    private function getById($id)
    {
        return $this->postModel::findOrFail($id);
    }

    private function getAllcategory()
    {
        return $this->catModel::select('id', 'title_en', 'title_ar')->get();
    }

    private function getAlltaqs()
    {
        return $this->taqModel::all();
    }

    private function getPostFirst($id)
    {
        return $this->postModel::where('id', $id)->with('category', 'user')->first();
    }
    private function getPostWithCat($id)
    {
        return $this->postModel::where('id', $id)->with('category')->first();
    }
}
