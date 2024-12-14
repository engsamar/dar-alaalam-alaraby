<?php

namespace App\Models\Article;

use App\Models\Model;
use App\Helpers\Constants;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model implements HasMedia
{
    use HasFactory;
    use HasTranslations;
    use InteractsWithMedia;
    public $translatable = [
        'title', 'description','keywords',
        'tags',
        'sub_title',
        'writer',
    ];

    protected $fillable = [
        'title',
        'slug',
        'image',
        'type',
        'position',
        'active',
        'description',
        'keywords',
        'tags',
        'sub_title',
        'date',
        'writer',
        'catalogue_id'
    ];

    public function catalogue()
    {
        return $this->belongsTo(Catalogue::class, 'catalogue_id');
    }

    public function tags()
    {
        return $this->hasMany(ArticleTag::class);
    }

    public function getUrlAttribute()
    {
        return route('website.articles.show', ['locale' => app()->getLocale(),'slug' => $this->slug]);
    }

    public function getImagesAttribute()
    {
        $images = [];
        $files = $this->getMedia('document');
        if (!empty($files)) {
            foreach ($files as $file) {
                array_push($images, $file->getFullUrl());
            }
        }

        return $images;
    }

}
