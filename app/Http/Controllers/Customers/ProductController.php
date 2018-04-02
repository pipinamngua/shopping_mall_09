<?php

namespace App\Http\Controllers\Customers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\ProductColor;
use App\Model\ProductAttribute;
use App\Model\Images;
use Illuminate\Support\Facades\DB;
use App\Repositories\InterfaceRepository\ProductInterfaceRepository;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $productRepository;

    public function __construct(ProductInterfaceRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    

    public function show($id)
    {

        return view('customers.detailProduct', compact('id'));
    }


    public function getLatestProduct()
    {
        $lastest = $this->productRepository->getLatestProduct();

        return $lastest;
    }

    public function getAllProduct()
    {
        $allProduct = $this->productRepository->getAllDiscountProduct();

        return $allProduct;
    }

    public function getDiscount($id)
    {
        $productDiscount = $this->productRepository->getDiscount($id);

        return response()->json(['productDiscount' => $productDiscount]);
    }

    public function getAttribute($id)
    {
        $productAttribute = $this->productRepository->getAttribute($id);

        return response()->json(['productAttribute' => $productAttribute]);
    }

    public function getColor($id, $colorId)
    {
        $images = $this->productRepository->getColor($id, $colorId);

        return $images;
    }

    public function relatedProduct($id)
    {
        $relatedProduct = $this->productRepository->relatedProduct($id);

        return response()->json(['relatedProduct' => $relatedProduct]);
    }

    public function getListProductByCategory($id)
    {
        $check = settype($id, 'int');
        if ($check) {
            $products = $this->productRepository->getProductByCategory($id);

            return view('customers.listProduct', compact([
                'products'
            ]));
        }
        
        return App::abort(404);
    }
}
