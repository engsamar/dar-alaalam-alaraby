<?php

namespace App\Models\User;

use App\Models\City;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'notes',
        'mobile',
        'is_main',
        'type_id',
        'latitude',
        'longitude',
        'address',
        'city_id',
        'user_id',
        'area_id',
        'floor_number',
        'building_number',
        'street',
    ];

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function area()
    {
        return $this->belongsTo(City::class, 'area_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function type()
    {
        return $this->belongsTo(AddressType::class, 'type_id');
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('id', 'desc');
    }

    // public function scopePublish($query)
    // {
    //     return $query->where('active', 1);
    // }
}
