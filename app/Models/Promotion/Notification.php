<?php

namespace App\Models\Promotion;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['title', 'message'];
    protected $fillable = [
        'title',
        'message',
        'model',
        'model_id',
        'user_id',
        'seen',
        'show_user',
        'show_delegate',
    ];

    public function scopeOrdered($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('id', 'desc');
    }
}
