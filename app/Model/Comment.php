<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    // Belong to
    public function belongToUser()
    {
        return $this->belongsTo('User::class');
    }

    public function belongToProduct()
    {
        return $this->belongsTo('Product::class');
    }

    // Has many
    public function hasManyComments()
    {
        return $this->hasMany('Comment::class', 'parent_id');
    }
}
