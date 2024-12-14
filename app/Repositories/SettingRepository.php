<?php

namespace App\Repositories;

use App\Models\Setting;
use App\Interfaces\SettingRepositoryInterface;

class SettingRepository implements SettingRepositoryInterface
{
    public function getImagesSettings()
    {
        return [
            'logo_white',
            'logo_footer',
            'breadcrumb',
            'login_image',
            'register_image'
        ];
    }

    public function getFirstSettings()
    {
        return Setting::first();
    }

    public function updateSetting($settingId, $newDetails)
    {
        return Setting::find($settingId)->update($newDetails);
    }
}
