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

    public function shope(){
        return $this->belongsTo('App\Models\Shope', 'shope_hash', 'shope_hash');
    }


}
