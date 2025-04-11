<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Ordering\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'mobile',
        'active',
        'gender',
        'birth_date',
        'password',
        'lang',
        'phone_verified_at',
        'image',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($pass)
    {
        $this->attributes['password'] = bcrypt($pass);
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('id', 'desc');
    }

    public function scopePublish($query)
    {
        return $query->where('active', 1);
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

    public function getRateAttribute()
    {
        return 3;
    }

    public function getNoOrdersAttribute()
    {
        return Order::where('user_id', $this->id)->count();
    }
}
