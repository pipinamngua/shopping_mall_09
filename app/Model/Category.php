<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    // Belong to
    public function belongToUser()
    {
        return $this->belongsTo('User::class');
    }

    // Has many
    public function hasManyCategories()
    {
        return $this->hasMany('Category::class', 'parent_id');
    }

    public function hasManyProducts()
    {
        return $this->hasMany('Product::class', 'category_id');
    }
}
