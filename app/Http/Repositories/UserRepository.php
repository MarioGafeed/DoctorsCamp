<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\UserInterface;
use App\Http\Traits\UserTrait;
use Spatie\Permission\Models\Role;
// use App\Http\Traits\HelperTrait;
use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Hash;


class UserRepository implements UserInterface
{
   private $viewPath = 'backend.users';
    use UserTrait;
    private $userModel;
    public function __construct(User $user)
    {
        $this->userModel = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($dataTable)
    {
      return $dataTable->render("{$this->viewPath}.index", [
          'title' => trans('main.show-all') . ' ' . trans('main.users')
      ]);
    }

    public function create()
    {
      return view("{$this->viewPath}.create", [
          'title' => trans('main.add') . ' ' . trans('main.users'),
          'roles' => Role::get(),
      ]);
    }

    public function store($request)
    {
        $requestAll = $request->all();
        // $requestAll['image'] = Helper::Upload('users', $request->file('image'), 'checkImages');
        $requestAll['password'] = Hash::make($request->password);

        $user = User::create($requestAll);

        $roles = $request['roles']; //Retrieving the roles field
        //Checking if a role was selected
        if (isset($roles)) {
            foreach ($roles as $role) {
                $role_r = Role::where('id', '=', $role)->firstOrFail();
                $user->assignRole($role_r); //Assigning role to user
            }
        }
        session()->flash('success', trans('main.added-message'));
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $user = $this->getById($id);
        return view("{$this->viewPath}.show", [
            'title' => trans('main.show') . ' ' . trans('main.user') . ' : ' . $user->name,
            'show' => $user,
        ]);
    }


    public function edit($id)
    {
        $user = $this->getById($id);
        return view("{$this->viewPath}.edit", [
            'title' => trans('main.edit') . ' ' . trans('main.user') . ' : ' . $user->name,
            'edit' => $user,
            'roles' => Role::get()
        ]);
    }

    public function update($request, $id)
    {
        $user = $this->getById($id);
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->has('password') && !empty($request->password) && !is_null($request->password)) {
            $user->password = Hash::make($request->password);
        }

        $user->type = $request->type;
        $user->phone = $request->phone;
        $user->active = $request->active;

        // if ($request->hasFile('image')) {
        //     $user->image = Helper::UploadUpdate($user->image ?? "", 'users', $request->file('image'), 'checkImages');
        // }
        $user->save();

        $roles = $request['roles']; //Retreive all roles

        if (isset($roles)) {
            $user->roles()->sync($roles);  //If one or more role is selected associate user to roles
        } else {
            $user->roles()->detach(); //If no role is selected remove exisiting role associated to a user
        }

        session()->flash('success', trans('main.updated'));
        return redirect()->route('users.show', [$user->id]);
    }

    public function destroy($id)
    {
      $redirect = true;
      $user = $this->getById($id );
      // if (file_exists(public_path('uploads/' . $user->image))) {
      //     @unlink(public_path('uploads/' . $user->image));
      // }
      $user->delete();

      if ($redirect) {
          session()->flash('success', trans('main.deleted-message'));
          return redirect()->route('users.index');
      }
    }


    /**
     * Remove the multible resource from storage.
     *
     * @param  array  $data
     * @return \Illuminate\Http\Response
     */
    public function multi_delete($request)
    {
      if (count($request->selected_data)) {
          foreach ($request->selected_data as $id) {
              $this->destroy($id, false);
          }
          session()->flash('success', trans('main.deleted-message'));
          return redirect()->route('users.index');
      }
    }
}
