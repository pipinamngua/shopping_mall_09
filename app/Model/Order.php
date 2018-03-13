<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    // Belong to
    public function belongToUser()
    {
        return $this->belongsTo('User::class');
    }

    // Has many
    public function hasManyOrderItems()
    {
        return $this->hasMany('OrderItem::class', 'order_id');
    }
}
