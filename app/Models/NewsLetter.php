<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsLetter extends Model
{
    use HasFactory;
    public $fillable = [
        'status',
        'email',
    ];

    public function scopeRecent($query)
    {
        return $query->orderBy('id', 'desc');
    }
}
