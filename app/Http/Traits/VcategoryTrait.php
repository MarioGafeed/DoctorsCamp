<?php
namespace App\Http\Traits;

trait VcategoryTrait
{
    private function getById($id)
    {
        return $this->vcategoryModel::findOrFail($id);
    }
}
