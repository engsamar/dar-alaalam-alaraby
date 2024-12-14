<?php

namespace App\Models;

use App\Helpers\Constants;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Banner extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['title', 'sub_title', 'image'];

    protected $fillable = [
        'title',
        'sub_title',
        'slug',
        'image',
        'type',
        'position',
        'active',
        'link',
    ];


    public function scopeFull($query)
    {
        return $query->where('type', Constants::FULL_BANNER);
    }

    public function scopeTwo($query)
    {
        return $query->where('type', Constants::TWO_BANNER);
    }

    public function scopeThree($query)
    {
        return $query->where('type', Constants::THREE_BANNER);
    }

    public function scopeSlider($query)
    {
        return $query->where('type', Constants::SLIDER_BANNER);
    }

    public function scopeNotSlider($query)
    {
        return $query->where('type', '!=', Constants::SLIDER_BANNER);
    }

    public function getTypeSpanAttribute()
    {
        $value = '';
        if ($this->type == Constants::SLIDER_BANNER) {
            $value = "<span class='badge rounded-pill badge-soft-danger font-size-11'> " . __('attributes.slider_banner') . "</span>";
        } else if ($this->type == Constants::TWO_BANNER) {
            $value = "<span class='badge rounded-pill badge-soft-info font-size-11'>" . __('attributes.two_banner') . "</span>";
        } else if ($this->type == Constants::FULL_BANNER) {
            $value = "<span class='badge rounded-pill badge-soft-primary font-size-11'>" . __('attributes.full_banner') . "</span>";
        } else if ($this->type == Constants::THREE_BANNER) {
            $value = "<span class='badge rounded-pill badge-soft-success font-size-11'>" . __('attributes.three_banner') . "</span>";
        }
        return $value;
    }
}
