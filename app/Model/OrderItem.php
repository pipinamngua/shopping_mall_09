<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    // Belong to
    public function belongToOrder()
    {
        return $this->belongsTo('Order::class');
    }

    public function belongToProductAttribute()
    {
        return $this->belongsTo('ProductAttribute::class');
    }
}
