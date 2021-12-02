<?php
namespace App\Http\Traits;

trait PtaqTrait
{
    private function getById($id)
    {
        return $this->ptaqModel::findOrFail($id);
    }
}
