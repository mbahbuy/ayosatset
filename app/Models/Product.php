<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getRouteKeyName()
    {
        return 'product_hash';
    }

    public function shop(){
        return $this->belongsTo('App\Models\Shop', 'shop_hash', 'shop_hash');
    }

    public function category(){
        return $this->belongsTo('App\Models\Category', 'slug', 'categories');
    }

}
