<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Interfaces\UserInterface;
use App\Http\Resources\UserResource;
use App\Http\Requests\UsersRequest;
use App\Models\User;
use App\Helpers\JsonResponder;

class UserController extends Controller
{
    public function __construct(private UserInterface $userInterface)
    {
    }

    public function showme(Request $request)
    {
       return new UserResource($request->user());
    }

    public function updateme(Request $request)
    {
      $user = $request->user();

      $requestall =  $request->validate([
          'name'        => ['required', 'max:255', 'min:3'],
          'phone'       => ['required'],
          'email'       => ['required', 'string', 'max:255', 'email'],
          'country_id'  => ['required'],
          'image'       => ['required'],
      ]);

        if ($user->update($request->only('name', 'phone', 'email', 'country_id', 'image'))) {

          return JsonResponder::make(trans('main.userupdated'));

        }

       return new UserResource($user);
    }
}
