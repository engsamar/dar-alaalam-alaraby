<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTag extends Model
{
    use HasFactory;
    protected $fillable = ['tag_id', 'product_id'];
    // tags

    public function tag()
    {
        return $this->belongsTo(Tag::class, 'tag_id');
    }
}
