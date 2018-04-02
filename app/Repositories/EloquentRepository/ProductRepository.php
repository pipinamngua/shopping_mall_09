<?php
namespace App\Repositories\EloquentRepository;

use App\Repositories\InterfaceRepository\ProductInterfaceRepository;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helpers;
use App\Model\Product;
use App\Model\ProductColor;
use App\Model\ProductAttribute;
use App\Model\Images;
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
        $check = Product::where([
            'product_name' => $input['product_name'],
            'category_id' => $input['category'],
        ])->get();
        if (!count($check)) {
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

            return response()->json(['product' => $product]);
        } else {
            return response()->json(['fail' => 'the product is already exits']);
        }
        
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

        return response()->json(['product' => $product]);
    }

    public function destroy($id)
    {
        return Product::destroy($id);
    }

    public function getLatestProduct()
    {
        $lastest = DB::table('products')
                ->leftJoin('discounts', 'products.id', '=', 'discounts.product_id')
                ->leftJoin('discount_program', 'discounts.discount_program_id', '=', 'discount_program.id')
                ->select(
                    'products.*',
                    'discounts.discount_percent',
                    'discount_program.discount_content',
                    'discount_program.started_at',
                    'discount_program.ended_at'
                )
                ->where([
                    'products.status' => 1,
                    'products.deleted_at' => null,
                ])
                ->orderBy('id', 'desc')
                ->take(8)->get();

        return response()->json(['lastest' => $lastest]);
    }

    public function getAllDiscountProduct()
    {
        $allProduct = DB::table('products')
                ->leftJoin('discounts', 'products.id', '=', 'discounts.product_id')
                ->leftJoin('discount_program', 'discounts.discount_program_id', '=', 'discount_program.id')
                ->select(
                    'products.*',
                    'discounts.discount_percent',
                    'discount_program.discount_content',
                    'discount_program.started_at',
                    'discount_program.ended_at'
                )
                ->where([
                    'products.status' => 1,
                    'products.deleted_at' => null,
                ])
                ->orderBy('id', 'desc')
                ->get();

        return response()->json(['allProducts' => $allProduct]);
    }

    public function getDiscount($id)
    {
        $productDiscount = DB::table('products')
                ->leftJoin('discounts', 'products.id', '=', 'discounts.product_id')
                ->leftJoin('discount_program', 'discounts.discount_program_id', '=', 'discount_program.id')
                ->select(
                    'products.*',
                    'discounts.discount_percent',
                    'discount_program.discount_content',
                    'discount_program.started_at',
                    'discount_program.ended_at'
                )
                ->where([
                    'products.status' => 1,
                    'products.deleted_at' => null,
                    'products.id' => $id,
                ])
                ->first();

        return $productDiscount;
    }

    public function getAttribute($id)
    {
        $productAttribute = DB::table('product_attributes')
                            ->join('colors', 'product_attributes.color_id', 'colors.id')
                            ->select('product_attributes.*', 'colors.color_name')
                            ->where(['product_attributes.product_id' => $id])
                            ->get();

        return $productAttribute;
    }
    
    public function getColor($id, $colorId)
    {
        $productColors = ProductColor::where([
            'color_id' => $colorId,
            'product_id' => $id,
        ])->first();

        $images = Images::where(['product_color_id' => $productColors->id])->get();

        return $images;
    }

    public function relatedProduct($id)
    {
        $product = Product::find($id);
        $relatedProduct = DB::table('products')
                ->leftJoin('discounts', 'products.id', '=', 'discounts.product_id')
                ->leftJoin('discount_program', 'discounts.discount_program_id', '=', 'discount_program.id')
                ->select(
                    'products.*',
                    'discounts.discount_percent',
                    'discount_program.discount_content',
                    'discount_program.started_at',
                    'discount_program.ended_at'
                )
                ->where([
                    'products.status' => 1,
                    'products.deleted_at' => null,
                    'products.category_id' => $product->category_id,
                ])
                ->orderBy('id', 'desc')
                ->take(8)->get();

        return $relatedProduct;
    }

    public function getProductByCategory($id)
    {
        $products = Product::where('category_id', '=', $id)
                    ->orderBy('id', 'desc')->get();

        return $products;
    }
}
