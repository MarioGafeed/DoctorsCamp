<?php
namespace App\Http\Traits;

trait VpostTrait
{
    private function getById($id)
    {
        return $this->vpostModel::findOrFail($id);
    }

    private function getAllvcategory()
    {
        return $this->vcatModel::select('id', 'title')->get();
    }
  

    private function getVpostFirst($id)
    {
        return $this->vpostModel::where('id', $id)->with('vcategory', 'user')->first();
    }
    private function getvPostWithvCat($id)
    {
        return $this->vpostModel::where('id', $id)->with('vcategory')->first();
    }
}
