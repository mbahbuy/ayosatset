<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getRouteKeyName()
    {
        return 'shop_hash';
    }

    public function user(){
        return $this->belongsTo('App\Models\User', 'user_hash', 'user_hash');
    }

    public function product(){
        return $this->hasMany('App\Models\Product', 'shop_hash', 'shop_hash');
    }
}
