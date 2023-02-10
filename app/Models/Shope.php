<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shope extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getRouteKeyName()
    {
        return 'shope_hash';
    }

    public function user(){
        return $this->belongsTo('App\Models\User', 'user_hash', 'user_hash');
    }

    public function product(){
        return $this->hasMany('App\Models\Product', 'shope_hash', 'shope_hash');
    }

}
