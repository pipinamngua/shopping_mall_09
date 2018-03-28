<?php

namespace App\Repositories\EloquentRepository;

use Auth;
use Illuminate\Support\Facades\DB;
use App\Model\Images;
use App\Model\ProductAttribute;
use App\Model\ProductColor;
use App\Http\Requests\StoreProductAttributes;
use App\Helpers\Helpers;
use App\Model\Product;
use App\Repositories\InterfaceRepository\ProductDetailInterfaceRepository;

class ProductDetailRepository implements ProductDetailInterfaceRepository
{
    public function store(array $input)
    {
        $checkProductAttribute = ProductAttribute::where('color_id', '=', $input['color_id'])->first();
        if ($checkProductAttribute) {
            return response()->json(['fail' => 'the item is already exits']);
        } else {
            $productColor = new ProductColor();
            $productColor->product_id = $input['product_id'];
            $productColor->color_id = $input['color_id'];
            $productColor->save();
       
            for ($i = 0; $i<count($input['image']); $i++) {
                $fileName = Helpers::getImage($input['image'][$i]);
                $image = new Images();
                $image->image_path = $fileName;
                $image->product_color_id = $productColor->id;
                $image->save();
            }
            $productAttribute = new ProductAttribute();
            $productAttribute->product_id = $input['product_id'];
            $productAttribute->size_id = $input['size_id'];
            $productAttribute->quantity = $input['quantity'];
            $productAttribute->color_id = $input['color_id'];
            $productAttribute->save();

            $latest = DB::table('product_attributes')
                ->join('products', 'product_attributes.product_id', '=', 'products.id')
                ->join('sizes', 'product_attributes.size_id', '=', 'sizes.id')
                ->join('colors', 'product_attributes.color_id', '=', 'colors.id')
                ->select(
                    'product_attributes.*',
                    'products.product_name',
                    'original_price',
                    'sizes.size_name',
                    'colors.color_name'
                )
                ->latest()
                ->first();

            return response()->json(['lastest' => $latest]);
        }
    }

    public function show($id)
    {
        $all = DB::table('product_attributes')
            ->join('products', 'product_attributes.product_id', '=', 'products.id')
                ->join('sizes', 'product_attributes.size_id', '=', 'sizes.id')
                ->join('colors', 'product_attributes.color_id', '=', 'colors.id')
                ->select(
                    'product_attributes.*',
                    'products.product_name',
                    'original_price',
                    'sizes.size_name',
                    'colors.color_name'
                )
                ->where('product_attributes.product_id', '=', $id)
                ->orderBy('id', 'desc')
                ->get();

        return $all;
    }

    public function getColorImages($id, $colorId)
    {
        $colorImages = DB::table('products_colors')
                    ->join('images', 'products_colors.id', '=', 'images.product_color_id')
                    ->select('products_colors.*', 'images.*')
                    ->where(['products_colors.color_id' => $colorId, 'products_colors.product_id' => $id])
                    ->get();

        return $colorImages;
    }

    public function update(array $input, $id)
    {
        if ($input['image']) {
            for ($i = 0; $i<count($input['image']); $i++) {
                $fileName = Helpers::getImage($input['image'][$i]);
                $productColor = ProductColor::where('color_id', '=', $request->color_id)->first();
                $updateImage = Images::where('product_color_id', '=', $productColor->id)->first();
                $updateImage->image_path = $fileName;
                $updateImage->save();
            }
            $updateProductAttr = ProductAttribute::find($id);
            $updateProductAttr->size_id = $input['size_id'];
            $updateProductAttr->quantity = $input['quantity'];
            $updateProductAttr->save();

            return $updateProductAttr;
        }
        $updateProductAttr = ProductAttribute::find($id);
        $updateProductAttr->size_id = $input['size_id'];
        $updateProductAttr->quantity = $input['quantity'];
        $updateProductAttr->save();

        return $updateProductAttr;
    }

    public function delete($id, $colorId)
    {
        ProductAttribute::destroy($id);
        $productColor = ProductColor::where('color_id', '=', $colorId)->first();
        Images::where('product_color_id', '=', $productColor->id)->delete();

        return response()->json(['success' => 'deletesuccess']);
    }
}