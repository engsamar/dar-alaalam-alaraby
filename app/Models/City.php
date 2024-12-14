<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['title'];

    protected $fillable = [
        'title',
        'position',
        'active',
        'city_id'
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