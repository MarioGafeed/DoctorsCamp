<?php
namespace App\Http\Traits;

trait EventTrait
{
  private function getById($id)
  {
      return $this->eventModel::findOrFail($id);
  }
  private function getAllCountries()
  {
      return $this->countryModel::select('id','name')->get();
  }
}
