<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
  public function changeLang($lang)
  {
      if (in_array($lang, ['ar', 'en'])) {
          session()->put('lang', $lang);
      }
      return redirect()->back();
  }

  public function logout()
    {
        auth()->logout();
        return redirect('/login');
    }
    
}
