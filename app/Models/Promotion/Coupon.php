<?php

namespace App\Models\Promotion;

use App\Models\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Coupon extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['title'];

    public $fillable = [
        'title',
        'order_id',
        'user_id',
        'position',
        'started_at',
        'expired_at',
        'active',
        'type',
        'discount',
        'maximum_usage',
        'code',
        'max_value_discount',
        'total_order_amount',
        'condition',
        'image',
        'coupon_type', //0 => normal ,1 => register,invitation
        'notify_type', //1 send notification only & 0 send notification with coupon
        'notify_days', // no of days before sending notification
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class)->select('name', 'id', 'name');
    }

    public function getNoUsedAttribute()
    {
        return \App\Models\Ordering\Order::where('coupon_id', $this->id)->count();
    }


    public function scopeSingle($query)
    {
        return $query->where('is_bulk', 0)->where('coupon_type', 0);
    }

    public function scopeOffer($query)
    {
        return $query->where('is_bulk', 0)->where('coupon_type', '>', 0);
    }


    public function scopeUserType($query)
    {
        return $query->whereNotNull('user_id');
    }

    public function scopeNotUser($query)
    {
        return $query->whereNull('user_id');
    }

    public function scopeAvailable($query)
    {
        return $query->publish()->whereDate('started_at', '<=', date('Y-m-d'))
            ->whereDate('expired_at', '>=', date('Y-m-d'));
    }

    public function scopeValid($query)
    {
        return $query->where(function ($q) {
            $q->whereDate('expired_at', '>=', now());
            $q->whereDate('started_at', '<=', now());
        });
    }

    public function getTypeSpanAttribute()
    {
        if ($this->type == 0) {
            return "<span class='badge badge-pill badge-warning'>" . __('titles.Percent') . '</span>';
        } elseif ($this->type == 1) {
            return "<span class='badge badge-pill badge-info'>" . __('titles.Value') . '</span>';
        }
    }

    public function getUsedSpanAttribute()
    {
        if (\App\Models\Ordering\Order::where('coupon_id', $this->id)->count() > 0) {
            return "<span class='badge badge-pill badge-success'>" . __('titles.Used') . '</span>';
        }
        return "<span class='badge badge-pill badge-default'>" . __('titles.NotUsed') . '</span>';
    }

    public function user_usages()
    {
        return $this->hasMany(\App\Models\Ordering\Order::class, 'coupon_id');
    }
}
