<?php
namespace App\Http\Traits;

trait PcategoryTrait
{
    private function getById($id)
    {
        return $this->pcategoryModel::findOrFail($id);
    }
}
