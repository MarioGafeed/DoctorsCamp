<?php
namespace App\Http\Traits;

trait VpostTrait
{
    private function getById($id)
    {
        return $this->vpostModel::findOrFail($id);
    }

    private function getAllcategory()
    {
        return $this->catModel::select('id', 'title_en', 'title_ar')->get();
    }


    private function getVpostFirst($id)
    {
        return $this->vpostModel::where('id', $id)->with('category', 'user')->first();
    }
    private function getvPostWithCat($id)
    {
        return $this->vpostModel::where('id', $id)->with('category')->first();
    }
}
