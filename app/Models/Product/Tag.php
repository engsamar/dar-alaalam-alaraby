<?php

namespace App\Models\Product;

use App\Models\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['title'];

    protected $fillable = [
        'title',
        'position',
        'active',
        'image',
        'slug',
        'type' //product or article
    ];



    public function scopeArticle($query)
    {
        return $query->where('type', \App\Helpers\Constants::ARTICLE_TAG_TYPE);
    }


    public function scopeProduct($query)
    {
        return $query->where('type', \App\Helpers\Constants::PRODUCT_TAG_TYPE);
    }

}
