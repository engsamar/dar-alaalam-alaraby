<?php

namespace App\Models\Ordering;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'old_status',
        'status',
        'order_id',
    ];
}
