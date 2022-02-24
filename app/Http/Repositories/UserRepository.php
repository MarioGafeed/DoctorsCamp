<?php

namespace App\Http\Repositories;

use App\Helpers\Helper;
use App\Http\Interfaces\UserInterface;
use App\Http\Traits\UserTrait;
use App\Models\User;
use App\Models\Country;
use Hash;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Http\UploadedFile;

class UserRepository implements UserInterface
{
    private $viewPath = 'backend.users';
    use UserTrait;

    private $userModel, $countryModel;

    public function __construct(User $user, Country $countryModel)
    {
        $this->userModel = $user;
        $this->countryModel = $countryModel;
    }

    public function index($dataTable)
    {
        return $dataTable->render("{$this->viewPath}.index", [
          'title' => trans('main.show-all').' '.trans('main.users'),
      ]);
    }

    public function create()
    {
      $countries = $this->getAllCountries();
        return view("{$this->viewPath}.create", [
          'title'     => trans('main.add').' '.trans('main.users'),
          'roles'     => Role::get(),
          'countries' => $countries,
      ]);
    }

    public function store(array $data)
    {
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            $user->addMedia($data['image'])->toMediaCollection();
        }

        $roles = $data['roles'] ?? [];

        if (isset($roles)) {
            foreach ($roles as $role) {
                $role_r = Role::where('id', '=', $role)->firstOrFail();
                $user->assignRole($role_r); //Assigning role to user
            }
        }
        return $user;
    }

    public function show($id)
    {
        $user = $this->getById($id);

        return view("{$this->viewPath}.show", [
            'title' => trans('main.show').' '.trans('main.user').' : '.$user->name,
            'show' => $user,

        ]);
    }

    public function edit($id)
    {
        $user = $this->getById($id);
        $countries = $this->getAllCountries();

        return view("{$this->viewPath}.edit", [
            'title' => trans('main.edit').' '.trans('main.user').' : '.$user->name,
            'edit' => $user,
            'roles' => Role::get(),
            'countries' => $countries,
        ]);
    }

    public function update(array $data, $id)
    {
        $user = $this->getById($id);
        $user->name  =    $data['name'];
        $user->email =    $data['email'];

        if (isset($data['password']) && ! empty($data['password']) && ! is_null($data['password']) ) {
            $user->password = Hash::make($data['password']);
        }

        $user->type        = $data['type'];
        $user->phone       = $data['phone'];
        $user->active      = $data['active'];
        $user->country_id  = $data['country_id'];

        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            $user->clearMediaCollection();
            $user->addMedia($data['image'])->toMediaCollection();
        }

        $user->save();

        $roles = $data['roles'] ?? [];

        if (isset($roles)) {
            $user->roles()->sync($roles);  //If one or more role is selected associate user to roles
        } else {
            $user->roles()->detach(); //If no role is selected remove exisiting role associated to a user
        }
        return $user;
    }

    public function destroy($id)
    {
        $redirect = true;
        $user = $this->getById($id);

        $user->clearMediaCollection();

        $user->delete();

        if ($redirect) {
            return $user;
        }
    }

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
