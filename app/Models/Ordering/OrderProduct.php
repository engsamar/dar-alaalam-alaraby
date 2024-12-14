<?php

namespace App\Models\Ordering;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'image',
        'description',
        'product_id',
        'order_id',
        'unit_price',
        'price',
        'quantity',
        'total_price',
        'discount',
        'discount_value',
        'size_id',
        'stock_id',
        'color_id',
     ];

    public function product()
    {
        return $this->belongsTo(\App\Models\Product\Product::class, 'product_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function color()
    {
        return $this->belongsTo(\App\Models\Product\Color::class, 'color_id');
    }


    public function stock()
    {
        return $this->belongsTo(\App\Models\Product\Stock::class, 'stock_id');
    }

    public function size()
    {
        return $this->belongsTo(\App\Models\Product\Size::class, 'size_id');
    }
}
