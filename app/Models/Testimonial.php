<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

class Testimonial extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['title', 'description'];
    protected $fillable = [
        'title',
        'slug',
        'image',
        'position',
        'active',
        'date',
        'description',
    ];
}
