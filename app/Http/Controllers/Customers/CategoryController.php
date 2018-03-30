<?php

namespace App\Http\Controllers\Customers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Repositories\InterfaceRepository\CategoryInterfaceRepository;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryInterfaceRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getIndex()
    {
        $categories = $this->categoryRepository->all();

        return response()->json(['categories' => $categories]);
    }
}
