<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = [
        'title',
        'about',
        'footer',
        'address',
        'logo',
        'copyrights',
        'terms_condition',
        'return_description',
        'privacy_description'
    ];
    public $fillable = [
        'title',
        'about',
        'footer',
        'address',
        'email',
        'phone',
        'whatsApp',
        'facebook',
        'twitter',
        'youTube',
        'linkedIn',
        'instagram',
        'logo',
        'background_image',
        'terms_condition',
        'return_description',
        'privacy_description',
        'app_version',
        'api_version',
        'googlePlay',
        'appStore',
        'logo_white',
        'copyrights',
        'vat',
        'logo_footer',
        'breadcrumb',
        'map',
        'register_image',
        'login_image',
        'delivery_cost'
    ];

    public function imagePath($column)
    {
        $value = '';
        if ($this->{$column} != '') {
            $value = asset($this->{$column});
        }

        return $value;
    }

    public function logoPath($key)
    {
        $value = $this->getTranslation('logo', $key);

        if ($value != '') {
            $value = asset($value);
        }

        return $value;
    }
}
