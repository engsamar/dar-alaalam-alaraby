<?php

namespace App\Models\Product;

use App\Helpers\Constants;
use App\Models\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['title'];

    protected $fillable = [
        'title',
        'position',
        'active',
        'category_id',
        'image',
        'slug'
    ];

    public function parent()
    {
        return $this->belongsTo(self::class, 'category_id');
    }

    public function scopeCategory($query)
    {
        return $query->whereNull('category_id');
    }

    public function scopeSubCategory($query)
    {
        return $query->whereNotNull('category_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'category_id');
    }

    public function getUrlAttribute()
    {
        return route('website.store.index', ['locale' => app()->getLocale(),'category' => $this->slug]);
    }


}
