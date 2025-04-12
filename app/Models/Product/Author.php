<?php

namespace App\Models\Product;

use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

class Author extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['title'];

    protected $fillable = [
        'title',
        'position',
        'active',
        'image',
        'birth_date',
        'slug',
        'country_id',
        'city_id',
        'category_id',
        'nationality_id',
        'email',
        'phone',
        'fax', ];

    public function getUrlAttribute()
    {
        return route('website.store.index', ['locale' => app()->getLocale(), 'brand' => $this->slug]);
    }

    public function getImagePathAttribute()
    {
        $value = $this->image;
        if ($value != '') {
            $value = asset($value);
        } else {
            $value = asset('profile.png');
        }

        return $value;
    }
}
