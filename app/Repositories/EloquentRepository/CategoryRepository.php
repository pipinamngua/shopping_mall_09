<?php
namespace App\Repositories\EloquentRepository;

use App\Repositories\InterfaceRepository\CategoryInterfaceRepository;
use App\Model\Category;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Model\User;
use App\Http\Requests\StoreCategory;

class CategoryRepository implements CategoryInterfaceRepository
{
    public function all()
    {
        return Category::orderBy('id', 'desc')->get();
    }

    public function find($id)
    {
        return Category::find($id);
    }

    public function store(array $input)
    {
        $category = new Category();
        $check = Category::where([
            'category_name' => $input['category_name'],
            'parent_id' => $input['parent_id']
        ])->get();
        if (count($check)) {
            return response()->json(['fail' => 'the category is already exists.Please choose another name!']);
        } else {
            $category->category_name = $input['category_name'];
            $category->parent_id = $input['parent_id'];
            $category->user_id = Auth::user()->id;
            $category->save();

            return response()->json(['category' => $category]);
        }
    }

    public function update(array $input, $id)
    {
        $category = Category::findOrFail($id);
        $check = Category::where([
            'category_name' => $input['category_name'],
            'parent_id' => $input['parent_id']
        ])->get();
        if (count($check)) {
            return response()->json(['fail' => 'can not updated, the category is already exists']);
        } else {
            $category->update([
                'category_name' => $input['category_name'],
                'parent_id' => $input['parent_id'],
                'user_id' => Auth::user()->id,
            ]);
            
            return $category;
        }
    }

    public function destroy($id)
    {
        return Category::destroy($id);
    }

    public function getAll()
    {
        return Category::select('id', 'category_name', 'slug', 'parent_id')->get();
    }
}
