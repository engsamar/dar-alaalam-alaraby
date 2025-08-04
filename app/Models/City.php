<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

class City extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['title'];

    protected $fillable = [
        'title',
        'position',
        'active',
        'city_id',
        'delivery_price',
    ];

    public function scopeCity($query)
    {
        return $query->whereNull('city_id');
    }

    public function scopeArea($query)
    {
        return $query->whereNotNull('city_id');
    }
}
