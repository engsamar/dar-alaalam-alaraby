<?php

namespace App\Models;

use App\Models\Model;
use App\Helpers\Constants;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Feedback extends Model
{
    use HasFactory;
    protected $fillable = [
        'status',
        'name',
        'email',
        'mobile',
        'user_id',
        'message',
        'notes',
        'subject'

    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function getStatusSpanAttribute()
    {
        $value = "";
        switch ($this->status) {
            case Constants::PENDING_REQUEST:
                $value = "<span class='badges bg-lightred'> ".__('attributes.new')."</span>";
                break;
            case Constants::IN_REVIEW_REQUEST:
                $value = "<span class='badges bg-lightgreen'>".__('attributes.opened')."</span>";
                break;
            case Constants::CLOSED_REQUEST:
                $value = "<span class='badges bg-lightgreen'>".__('attributes.closed')."</span>";
                break;
            default:
                $value ="";
                break;
        }
        return $value;
    }
}
