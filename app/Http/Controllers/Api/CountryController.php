<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Http\Resources\CountryResource;

class CountryController extends Controller
{
  public function index()
  {
    $countries = Country::select('id', 'name', 'code')->get();

    return CountryResource::collection($countries);
  }
}
