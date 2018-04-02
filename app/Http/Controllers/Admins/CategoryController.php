<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Product;
use Auth;
use App\Http\Requests\StoreCategory;
use App\Repositories\InterfaceRepository\CategoryInterfaceRepository;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $categoryRepository;

    public function __construct(CategoryInterfaceRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }


    public function index(Request $request)
    {
        $categories = $this->categoryRepository->all();

        return response()->json(['categories' => $categories]);
    }

    public function showVueCategory()
    {
        return view('admin.categories.categories');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategory $request)
    {
        $input = $request->only('category_name', 'parent_id');
        $category = $this->categoryRepository->store($input);

        return $category;
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->only('category_name', 'parent_id');
        $update = $this->categoryRepository->update($input, $id);

        return $update;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->categoryRepository->destroy($id);
        
        return response()->json(['message' => 'deleted successfully']);
    }

    public function getAllCategory()
    {
        $categories = $this->categoryRepository->all();

        return $categories;
    }
}
