<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Images extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    // Belong to
    public function belongToProductColor()
    {
        return $this->belongsTo('ProductColor::class');
    }
}
