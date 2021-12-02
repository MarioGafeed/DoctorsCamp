<?php
namespace App\Http\Traits;

trait VtaqTrait
{
    private function getById($id)
    {
        return $this->vtaqModel::findOrFail($id);
    }
}
