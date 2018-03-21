<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductAttribute extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    // Belong to
    public function belongToProduct()
    {
        return $this->belongsTo(Product::class);
    }

    public function belongToSize()
    {
        return $this->belongsTo(Size::class);
    }

    public function belongToColor()
    {
        return $this->belongsTo(Color::class);
    }

    // Has many
    public function hasManyOrderItems()
    {
        return $this->hasMany(OrderItem::class, 'product_attribute_id');
    }
}
