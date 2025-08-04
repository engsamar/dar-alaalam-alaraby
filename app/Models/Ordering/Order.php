<?php

namespace App\Models\Ordering;

use App\Helpers\Constants;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'vat_value',
        'mobile',
        'name',
        'email',
        'vat',
        'shipping_method',
        'shipping_cost',
        'discount',
        'total_discount',
        'coupon_discount',
        'total_price',
        'status_id',
        'payment_status',
        'user_id',
        'coupon_id',
        'address_id',
        'store_id',
        'payment_method',
        'reference_number',
        'address_detail',
        'latitude',
        'longitude',
        'comments',
        'notes',
        'coupon_code',
        'transaction_id',
        'transaction_type',
        'transaction_link',
        'transaction_status',
        'transaction_message',
        'order_uuid',
        'delivery_cost',
        'address_id',
        'address',
        'floor_number',
        'building_number',
        'street',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function store()
    {
        return $this->belongsTo(\App\Models\Store\Store::class, 'store_id');
    }

    public function coupon()
    {
        return $this->belongsTo(\App\Models\Promotion\Coupon::class, 'coupon_id');
    }

    public function address()
    {
        return $this->belongsTo(User\Address::class, 'address_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function scopeDelivered($query)
    {
        return $query->where('status_id', Constants::ORDER_STATUS_DELIVERED);
    }

    // cancelled processing
    public function scopeProcessing($query)
    {
        return $query->where('status_id', '>=', Constants::ORDER_STATUS_ACCEPTED);
    }

    public function scopeCancelled($query)
    {
        return $query->whereIn('status_id', [Constants::ORDER_STATUS_CANCELED, Constants::ORDER_STATUS_REJECTED]);
    }

    public function scopePaid($query)
    {
        return $query->where('payment_status', 1);
    }

    public function scopePublish($query)
    {
        return $query->where('payment_status', 1);
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('id', 'desc');
    }

    public function getPaymentStatusSpanAttribute($value)
    {
        switch ($this->payment_status) {
            case Constants::ORDER_PAY_STATUS_PENDING:
                $value = "<span class='badge rounded-pill badge-soft-warning pending-style style1 font-size-11'>Pending</span>";
                break;
            case Constants::ORDER_PAY_STATUS_REJECTED:
                $value = "<span class='badge rounded-pill badge-soft-danger pending-style style3 font-size-11'>Rejected</span>";
                break;
            case Constants::ORDER_PAY_STATUS_ACCEPTED:
                $value = "<span class='badge rounded-pill badge-soft-success pending-style style4 font-size-11'>Paid</span>";
                break;
        }

        return $value;
    }

    public function getPaymentMethodSpanAttribute($value)
    {
        switch ($this->payment_method) {
            case Constants::ORDER_PAY_METHOD_CASH:
                $value = "<span class='badge rounded-pill badge-soft-success pending-style style4 font-size-11'>CASH</span>";
                break;
            case Constants::ORDER_PAY_METHOD_PAYFORT:
                $value = "<span class='badge rounded-pill badge-soft-danger pending-style style3 font-size-11'>PAYFORT</span>";
                break;
        }

        return $value;
    }

    public function getDateAttribute()
    {
        return date('Y-m-d', strtotime($this->created_at));
    }

    // products
    public function products()
    {
        return $this->hasMany(OrderProduct::class, 'order_id');
    }

    public function getNoProductsAttribute()
    {
        return OrderProduct::where('order_id', $this->id)->sum('quantity');
    }
}
