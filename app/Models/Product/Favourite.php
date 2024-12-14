<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    use HasFactory;

    protected $fillable = ['status', 'product_id', 'user_id'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('id', 'desc');
    }

    public function scopePublish($query)
    {
        return $query->where('status', 1);
    }
}
