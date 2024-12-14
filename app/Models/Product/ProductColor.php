<?php

namespace App\Models\Product;

use App\Models\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductColor extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['title'];

    protected $fillable = [
        'title',
        'color_id',
        'size_id',
        'product_id',
        'stock_id',
        'default',
        'color_code',
        'price',
        'discount',
    ];

}
