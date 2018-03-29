<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discount extends Model
{
    // use SoftDeletes;
    protected $table = 'discounts';

    // protected $guarded = ['id'];

    // Belong to
    public function belongToProduct()
    {
        return $this->belongsTo(Product::class);
    }

    public function belongToDiscountProgram()
    {
        return $this->belongsTo(Product::class);
    }
}
