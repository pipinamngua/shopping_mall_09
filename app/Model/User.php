<?php

namespace App\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use SoftDeletes, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'verify_token',
        'status',
        'role_id'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    // Has many
    public function hasManyCategories()
    {
        return $this->hasMany('Category::class', 'user_id');
    }

    public function hasManyProducts()
    {
        return $this->hasMany('Product::class', 'user_id');
    }

    public function hasManyComments()
    {
        return $this->hasMany('Comment::class', 'user_id');
    }

    public function hasManyRates()
    {
        return $this->hasMany('Rate::class', 'user_id');
    }

    public function hasManyOrders()
    {
        return $this->hasMany('Order::class', 'user_id');
    }
}
