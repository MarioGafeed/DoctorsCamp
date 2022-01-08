<?php

namespace App\Http\Traits;

trait CategoryTrait
{
    private function getById($id)
    {
        return $this->categoryModel::findOrFail($id);
    }
}
