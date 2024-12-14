<?php

namespace App\Models\Ordering;

use App\Models\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Status extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['title'];

    protected $fillable = [
        'title',
        'position',
        'active',
        'image',
        'slug'
    ];

    public function getUrlAttribute()
    {
        return route('website.store.index', ['locale' => app()->getLocale(),'brand' => $this->slug]);
    }

}
