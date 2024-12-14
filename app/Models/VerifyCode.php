<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifyCode extends Model
{
    use HasFactory;
    protected $fillable = [
        'mobile',
        'code',
        'type',
        'expired_at',
        'status'
    ];
}
