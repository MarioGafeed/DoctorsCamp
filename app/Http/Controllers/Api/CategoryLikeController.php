<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CategoryLikeController extends Controller
{
  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'categories'   => 'required|array',
      'categories.*' => 'required|in:categories',
    ]);

// First Unlike all categories user liked before
    $oldcategories = Category::whereLikedBy($user->id)->get();

    if ( $oldcategories->isNotEmpty() ) {
      foreach ( $oldcategories as $category ) {
        if ( $category->liked() ) {
          $category->unlike();
        }
      }
    }
// Second: Save liked Categories collection for user
    $categories = collect($request->categories);

    foreach ($categories as  $category) {
      $category = Category::findOrFail($category);
      $category->like();
    }

    return response()->json([
      'message' => trans('main.categorylike')
    ]);
  }
}
