<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DiscountProgram extends Model
{
    use SoftDeletes;
    protected $table = 'discount_program';

    // Has many
    public function hasManyDiscounts()
    {
        return $this->hasMany(Discount::class, 'discount_program_id');
    }
}
