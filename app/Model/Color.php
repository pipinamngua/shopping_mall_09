<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Color extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    // Has many
    public function hasManyProductAttributes()
    {
        return $this->hasMany(ProductAttribute::class, 'color_id');
    }

    public function hasManyProductsColors()
    {
        return $this->hasMany(ProductColor::class, 'color_id');
    }
}
