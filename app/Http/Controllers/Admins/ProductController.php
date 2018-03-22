<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product;
use Auth;
use App\Http\Requests\StoreProducts;
use App\Repositories\InterfaceRepository\ProductInterfaceRepository;

class ProductController extends Controller
{

    protected $productRepository;

    public function __construct(ProductInterfaceRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }


    public function showVueProduct()
    {
        return view('admin.products.products');
    }

    public function index()
    {
        $product = $this->productRepository->getAllProduct();

        return $product;
    }


    public function store(StoreProducts $request)
    {
        $input = $request->only(
            'product_name',
            'description',
            'original_price',
            'status',
            'category',
            'image'
        );
        $product = $this->productRepository->store($input);

        return $product;
    }


    public function update(Request $request, $id)
    {
        $input = $request->only(
            'product_name',
            'description',
            'original_price',
            'status',
            'category',
            'image'
        );
        $product = $this->productRepository->update($input, $id);

        return $product;
    }


    public function destroy($id)
    {
        $this->productRepository->destroy($id);

        return response()->json(['message' => 'deleted successfully']);
    }
}
