<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{
    public $timestamps = true;

    public function scopeRecent($query)
    {
        return $query->orderBy('id', 'desc');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('position', 'asc');
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
            $value = asset('/default.jpeg');
        }

        return $value;
    }

    public function getActiveSpanAttribute()
    {
        $value = '';
        if ($this->active != 1) {
            $value = "<span class='badge rounded-pill badge-soft-danger font-size-11'> Draft</span>";
        } else {
            $value = "<span class='badge rounded-pill badge-soft-success font-size-11'>Publish</span>";
        }

        return $value;
    }

}
