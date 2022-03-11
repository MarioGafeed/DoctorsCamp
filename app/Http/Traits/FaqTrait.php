<?php

namespace App\Http\Traits;

trait FaqTrait
{
    private function getById($id)
    {
        return $this->faqModel::findOrFail($id);
    }
}
