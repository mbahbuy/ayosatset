<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getRouteKeyName()
    {
        return 'product_hash';
    }

    public function shop()
    {
        return $this->belongsTo('App\Models\Shop', 'shop_hash', 'shop_hash');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'categories', 'slug');
    }

    public function wish()
    {
        if (!auth()->check()) {
            return $this->belongsTo('App\Models\Cart', 'product_hash', 'product_hash')->where('parent_id', 2)->where('user_hash', false);
        }
        return $this->belongsTo('App\Models\Cart', 'product_hash', 'product_hash')->where('parent_id', 2)->where('user_hash', auth()->user()->user_hash);
    }

    public function cart()
    {
        if (!auth()->check()) {
            return $this->belongsTo('App\Models\Cart', 'product_hash', 'product_hash')->where('parent_id', 1)->where('user_hash', false);
        }
        return $this->belongsTo('App\Models\Cart', 'product_hash', 'product_hash')->where('parent_id', 1)->where('user_hash', auth()->user()->user_hash);
    }

    public function order(): BelongsToMany
    {
        return $this->belongsToMany('\App\Models\Order')->withPivot('pcs');
    }

    public function ratings()
    {
        return $this->hasMany('\App\Models\Rating', 'product_hash', 'product_hash');
    }

    public function averageRating()
    {
        $ratings = $this->ratings()->pluck('rating');
        if ($ratings->count() > 0) {
            return $ratings->sum() / $ratings->count();
        } else {
            return 0;
        }
    }
}
