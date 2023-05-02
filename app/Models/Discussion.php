<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['children', 'user'];

    public function user()
    {
        return $this->belongsTo('\App\Models\User', 'user_hash', 'user_hash');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent', 'discussion_hash');
    }
}
