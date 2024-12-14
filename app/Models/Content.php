<?php

namespace App\Models;

use App\Helpers\Constants;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Content extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['title', 'description'];

    protected $fillable = [
        'title',
        'slug',
        'image',
        'type',
        'position',
        'active',
        'description',
        'link',
        'counter',
        'sign',
        'mobile',
        'whats_app'

    ];


    public function scopeQuestion($query)
    {
        return $query->where('type', Constants::QUESTION_TYPE);
    }


    public function scopeClient($query)
    {
        return $query->where('type', Constants::CLIENT_TYPE);
    }

    public function scopeFeature($query)
    {
        return $query->where('type', Constants::FEATURE_TYPE);
    }

}
