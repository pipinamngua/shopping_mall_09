<?php
namespace App\Repositories\EloquentRepository;

use App\Repositories\InterfaceRepository\DiscountProductInterface;
use App\Model\Product;
use App\Model\Discount;
use Illuminate\Support\Facades\DB;
use App\Model\DiscountProgram;

class DiscountProductRepository implements DiscountProductInterface
{
    public function all()
    {
        $getAllDiscount = DB::table('discounts')
                        ->join('products', 'discounts.product_id', '=', 'products.id')
                        ->join('discount_program', 'discounts.discount_program_id', '=', 'discount_program.id')
                        ->select(
                            'discounts.*',
                            'products.product_name',
                            'discount_program.started_at',
                            'discount_program.ended_at',
                            'discount_program.discount_content'
                        )
                        ->get();

        return $getAllDiscount;
    }

    public function store(array $input)
    {
        foreach ($input['productName'] as $product) {
            $record = Discount::where([
                'product_id' => $product,
                'discount_program_id' => $input['discountProgram'],
            ])->first();
            if ($record) {
                return response()->json(['fail' => 'some records already exits!']);
            }
        }
        foreach ($input['productName'] as $product) {
            $discount = new Discount();
            $discount->product_id = $product;
            $discount->discount_program_id = $input['discountProgram'];
            $discount->discount_percent = $input['discountPercent'];
            $discount->save();
        }

        return $discount;
    }

    public function update(array $input, $id)
    {
        $record = Discount::where([
                'product_id' => $input['productName'],
                'discount_program_id' => $input['discountProgram'],
            ])->first();
        if ($record) {
            return response()->json(['fail' => 'cant not updated! the discount has been define']);
        } else {
            $update = Discount::find($id);
            $update->product_id = $input['productName'];
            $update->discount_program_id = $input['discountProgram'];
            $update->discount_percent = $input['discountPercent'];
            $update->save();

            return response()->json(['update' => $update]);
        }
    }

    public function destroy($id)
    {
        return Discount::destroy($id);
    }

    public function getAllProduct()
    {
        $product = Product::orderBy('id', 'desc')->get();

        return $product;
    }

    public function getAllDiscountProgram()
    {
        $discountProgram = DiscountProgram::where('status', '=', 1)->orderBy('id', 'desc')->get();

        return $discountProgram;
    }
}
