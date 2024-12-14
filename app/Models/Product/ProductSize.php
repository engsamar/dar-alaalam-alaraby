<?php

namespace App\Models\Product;

use App\Models\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductSize extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['title'];

    protected $fillable = [
        'title',
        'size_id',
        'product_id',
        'stock_id',
        'default',
        'weight',
        'price',
        'discount',
        'quantity'
    ];

    public function colors()
    {
        return $this->hasMany(ProductColor::class, 'size_id');
    }

    public function getColorIdsAttribute()
    {
        return $this->colors->pluck('color_id')->toArray();
    }

    public function getPriceAfterAttribute()
    {
        return $this->price - ($this->discount > 0 ? round($this->price * $this->discount / 100 ,2) : 0 );
    }


}
