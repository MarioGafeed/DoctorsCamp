<?php
namespace App\Http\Traits;

trait PostTrait
{
    private function getById($id)
    {
        return $this->postModel::findOrFail($id);
    }

    private function getAllpcategory()
    {
        return $this->catModel::select('id', 'title')->get();
    }

    private function getAlltaqs()
    {
        return $this->taqModel::all();
    }

    private function getPostFirst($id)
    {
        return $this->postModel::where('id', $id)->with('pcategory', 'user', 'ptaqs')->first();
    }
    private function getPostWithCat($id)
    {
        return $this->postModel::where('id', $id)->with('pcategory')->first();
    }
}
