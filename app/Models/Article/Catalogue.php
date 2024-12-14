<?php

namespace App\Models\Article;

use App\Models\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Catalogue extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['title'];

    protected $fillable = [
        'title',
        'position',
        'active',
    ];

    public function getUrlAttribute()
    {
        return route('website.articles.index', ['locale' => app()->getLocale(),'catalogue' => $this->slug]);
    }
}
