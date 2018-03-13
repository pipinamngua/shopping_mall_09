<?php
namespace App\Repositories\EloquentRepository;

use App\Repositories\InterfaceRepository\UserInterfaceRepository;
use App\Model\User;

class UserRepository implements UserInterfaceRepository
{
    public function all()
    {
        return User::all();
    }

    public function search($key)
    {
        return User::where('name', 'like', '%' . $key . '%')->get();
    }

    public function find($id)
    {
        return User::find($id);
    }

    public function paginate()
    {
        return User::paginate(config('user.paginate'));
    }

    public function update(array $input, $id)
    {
    }

    public function register()
    {
    }

    public function delete()
    {
        return User::destroy();
    }
}
