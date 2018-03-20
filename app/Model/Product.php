<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    protected $table = 'products';

    use SoftDeletes;

    protected $guarded = ['id'];

    // Belong to
    public function belongToUser()
    {
        return $this->belongsTo(User::class);
    }

    public function belongToCategory()
    {
        return $this->belongsTo(Category::class);
    }

    // Has many
    public function hasManyComments()
    {
        return $this->hasMany(Comment::class, 'product_id');
    }

    public function hasManyRates()
    {
        return $this->hasMany(Rate::class, 'product_id');
    }

    public function hasManyDiscounts()
    {
        return $this->hasMany(Discount::class, 'product_id');
    }

    public function hasManyProductAttributes()
    {
        return $this->hasMany(ProductAttribute::class, 'product_id');
    }

    public function hasManyProductsColors()
    {
        return $this->hasMany(ProductColor::class, 'product_id');
    }
}
