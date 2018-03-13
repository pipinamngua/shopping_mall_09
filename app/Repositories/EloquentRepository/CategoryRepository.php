<?php
namespace App\Repositories\EloquentRepository;

use App\Repositories\InterfaceRepository\UserInterfaceRepository;
use App\Model\Category;

class CategoryRepository implements UserInterfaceRepository
{
    public function all()
    {
        return Category::all();
    }

    public function find($id)
    {
        return Category::find($id);
    }
}
