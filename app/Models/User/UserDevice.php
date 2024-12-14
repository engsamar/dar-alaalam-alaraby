<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDevice extends Model
{
    use HasFactory;
    protected $fillable = ['fcm_token', 'device_id', 'lang', 'version', 'platform', 'user_id', 'status'];

}
