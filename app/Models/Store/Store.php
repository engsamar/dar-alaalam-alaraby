<?php

namespace App\Models\Store;

use App\Models\City;
use App\Models\Product\Category;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Store extends Authenticatable implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use HasTranslations;
    public $translatable = ['title','description','address'];

    protected $fillable = [
        'title',
        'description',
        'address',
        'position',
        'active',
        'category_id',
        'image',
        'logo',
        'phone',
        'email',
        'whatsapp',
        'latitude',
        'longitude',
        'city_id',
        'area_id',
        'is_popular',
        'delivery_time_from',
        'delivery_time_to',
        'online_status',
        'password'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
    public function area()
    {
        return $this->belongsTo(City::class, 'area_id');
    }
    //
    //get nearest store
    public function scopeDistance($query, $latitude, $longitude, $distance, $unit = "km")
    {
        $constant = $unit == "km" ? 6371 : 3959;
        $haversine = "(
        $constant * acos(
            cos(radians(" .$latitude. "))
            * cos(radians(`latitude`))
            * cos(radians(`longitude`) - radians(" .$longitude. "))
            + sin(radians(" .$latitude. ")) * sin(radians(`latitude`))
        )
        )";

        return $query->selectRaw("*, ROUND($haversine,2) AS distance")
            ->having("distance", "<=", $distance)->orderBy('distance', 'asc');
    }

    public function getImagePathAttribute()
    {
        $value = $this->image;
        if ($value != '') {
            $value = asset($value);
        } else {
            $value = asset('/default.jpeg');
        }

        return $value;
    }

    public function getLogoPathAttribute()
    {
        $value = $this->logo;
        if ($value != '') {
            $value = asset($value);
        } else {
            $value = asset('/default.jpeg');
        }

        return $value;
    }

    public function getRateAttribute()
    {
        return 3;
    }

    public function getPreprationTimeAttribute()
    {
        return $this->delivery_time_from.' '.$this->delivery_time_to;
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

    public function setPasswordAttribute($pass)
    {
        $this->attributes['password'] = bcrypt($pass);
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('id', 'desc');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('position', 'asc');
    }

    public function scopePublish($query)
    {
        return $query->where('active', 1);
    }

    public function getActiveSpanAttribute()
    {
        $value = '';
        if ($this->active != 1) {
            $value = "<span class='badge rounded-pill badge-soft-danger font-size-11'> Draft</span>";
        } else {
            $value = "<span class='badge rounded-pill badge-soft-success font-size-11'>Publish</span>";
        }

        return $value;
    }

}
