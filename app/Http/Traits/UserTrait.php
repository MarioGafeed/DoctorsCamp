<?php

namespace App\Http\Traits;

trait UserTrait
{
    private function getById($id)
    {
        return $this->userModel::findOrFail($id);
    }
    
    private function getAllCountries()
    {
        return $this->countryModel::select('id', 'name')->get();
    }
}
