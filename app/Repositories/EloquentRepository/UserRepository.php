<?php
namespace App\Repositories\EloquentRepository;

use App\Repositories\InterfaceRepository\UserInterfaceRepository;
use Illuminate\Database\Eloquent\Model;
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
        $user = User::findOrFail($id);
        $user->status = $input['status'];
        $user->save();
        
        return $user;
    }

    public function updateStatus(array $arr1, array $arr2)
    {
        return User::where($arr1)->update($arr2);
    }

    public function delete($id)
    {
        return User::destroy($id);
    }

    public function getUser(array $arr)
    {
        return User::where($arr)->first();
    }

    public function getFindOrFail($id)
    {
        return User::findOrFail($id);
    }
}
