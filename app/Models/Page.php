<?php

namespace App\Models;

use App\Helpers\Constants;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Page extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['title', 'description','sub_title'];

    protected $fillable = [
        'title',
        'slug',
        'image',
        'icon',
        'type',
        'position',
        'active',
        'description',
        'sub_title',
        'link',
    ];


    public function scopeVision($query)
    {
        return $query->where('type', Constants::VISION_PAGE_TYPE);
    }

    public function scopeMission($query)
    {
        return $query->where('type', Constants::MISSION_PAGE_TYPE);
    }

    public function scopeAbout($query)
    {
        return $query->where('type', Constants::ABOUT_PAGE_TYPE);
    }

    public function scopeSubscribe($query)
    {
        return $query->where('type', Constants::SUBSCRIBE_PAGE_TYPE);
    }

}
