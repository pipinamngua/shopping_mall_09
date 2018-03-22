<?php
namespace App\Repositories\EloquentRepository;

use App\Repositories\InterfaceRepository\ProductInterfaceRepository;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helpers;
use App\Model\Product;
use Auth;

class ProductRepository implements ProductInterfaceRepository
{
    public function getAllProduct()
    {
        $products = Product::orderBy('id', 'desc')->paginate(10);
        $response = [
            'pagination' => [
                'total' => $products->total(),
                'per_page' => $products->perPage(),
                'current_page' => $products->currentPage(),
                'last_page' => $products->lastPage(),
                'from' => $products->firstItem(),
                'to' => $products->lastItem(),
            ],
            'data' => $products,
        ];

        return $response;
    }

    public function store(array $input)
    {
        $fileName = Helpers::getImage($input['image']);
        $product = new Product();
        $product->product_name = $input['product_name'];
        $product->description = $input['description'];
        $product->original_price = $input['original_price'];
        $product->status = $input['status'];
        $product->category_id = $input['category'];
        $product->user_id = Auth::user()->id;
        $product->image_path = $fileName;
        $product->save();

        return $product;
    }

    public function update(array $input, $id)
    {
        $product = Product::findOrFail($id);
        if ($input['image']) {
            $fileName = Helpers::getImage($input['image']);
            $product->update([
                'product_name' => $input['product_name'],
                'description' => $input['description'],
                'original_price' => $input['original_price'],
                'status' => $input['status'],
                'category_id' => $input['category'],
                'image_path' => $fileName,
                'user_id' => Auth::user()->id,
            ]);
        } else {
            $product->update([
            'product_name' => $input['product_name'],
            'description' => $input['description'],
            'original_price' => $input['original_price'],
            'status' => $input['status'],
            'category_id' => $input['category'],
            'user_id' => Auth::user()->id,
            ]);
        }

        return $product;
    }

    public function destroy($id)
    {
        return Product::destroy($id);
    }
}
