<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductColor extends Model
{
    use SoftDeletes;
    protected $table = 'products_colors';

    protected $guarded = ['id'];

    // Belong to
    public function belongToProduct()
    {
        return $this->belongsTo(Product::class);
    }

    public function belongToColor()
    {
        return $this->belongsTo(Color::class);
    }

    // Has many
    public function hasManyImages()
    {
        return $this->hasMany(Image::class, 'product_color_id');
    }
}
