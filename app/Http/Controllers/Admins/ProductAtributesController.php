<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Model\Images;
use App\Model\ProductAttribute;
use App\Model\ProductColor;
use App\Http\Requests\StoreProductAttributes;
use App\Repositories\InterfaceRepository\ProductDetailInterfaceRepository;

class ProductAtributesController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    private $productDetailRepository;

    public function __construct(ProductDetailInterfaceRepository $productDetailRepository)
    {
        // dd('aa');
        $this->productDetailRepository = $productDetailRepository;
    }


    public function store(StoreProductAttributes $request)
    {
        $input = $request->only(
            'product_id',
            'size_id',
            'quantity',
            'color_id',
            'image'
        );

        return $this->productDetailRepository->store($input);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $allProduct = $this->productDetailRepository->show($id);

        return response()->json(['all' => $allProduct]);
    }

    public function getColorImages($id, $colorId)
    {
        $colorImages = $this->productDetailRepository->getColorImages($id, $colorId);

        return response()->json(['color_images' => $colorImages]);
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
        $input = $request->only(
            'product_id',
            'size_id',
            'quantity',
            'color_id',
            'image'
        );
        
        return $this->productDetailRepository->update($input, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id, $colorId)
    {
        $this->productDetailRepository->delete($id, $colorId);

        return response()->json(['success' => 'deletesuccess']);
    }
}
