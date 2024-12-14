<?php

namespace App\Models\Product;

use App\Helpers\Constants;
use App\Models\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity',
        'product_id',
        'production_date',
        'expiry_date',
        'weight',
        'price',
        'discount',
        'supplier_id'
    ];

}
