<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use App\Http\Requests\StoreDiscountProduct;
use App\Http\Controllers\Controller;
use App\Repositories\InterfaceRepository\DiscountProductInterface;

class DiscountProduct extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $discountProductRepository;
    public function __construct(DiscountProductInterface $discountProductRepository)
    {
        $this->discountProductRepository = $discountProductRepository;
    }

    public function index()
    {
        $getAllDiscount = $this->discountProductRepository->all();

        return $getAllDiscount;
    }

    public function showVueDiscountProduct()
    {
        return view('admin.discountProduct.discountProduct');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDiscountProduct $request)
    {
        $input = $request->only('productName', 'discountProgram', 'discountPercent');
        $discount = $this->discountProductRepository->store($input);

        return $discount;
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
        $input = $request->only('discountProgram', 'discountPercent', 'productName');

        return $this->discountProductRepository->update($input, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->discountProductRepository->destroy($id);
    }

    public function getAllProduct()
    {
        return $this->discountProductRepository->getAllProduct();
    }

    public function getAllDiscountProgram()
    {
        return $this->discountProductRepository->getAllDiscountProgram();
    }
}
