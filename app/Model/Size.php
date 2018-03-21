<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Size extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    // Has many
    public function hasManyProductAttributes()
    {
        return $this->hasMany(ProductAttribute::class, 'size_id');
    }
}
