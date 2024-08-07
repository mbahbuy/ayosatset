<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function product()
    {
        return $this->belongsTo('\App\Models\Product', 'product_hash', 'product_hash');
    }

    public function user()
    {
        return $this->belongsTo('\App\Models\User', 'user_hash', 'user_hash');
    }
}
