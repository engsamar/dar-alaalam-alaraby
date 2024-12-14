<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\SettingRepositoryInterface;

class SettingsController extends Controller
{
    private SettingRepositoryInterface $settingRepository;
    private $path = 'settings';

    public function __construct(SettingRepositoryInterface $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    public function index(Request $request)
    {
        $images = $this->settingRepository->getImagesSettings();
        $setting = $this->settingRepository->getFirstSettings();

        return view(
            'admin.settings.index',
            compact('images', 'setting')
        );
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $images = $this->settingRepository->getImagesSettings();

        foreach ($images as $item) {
            if ($request->hasFile($item)) {
                $data[$item] = \App\Helpers\Image::upload($request->file($item), $this->path);
            }
        }

        if ($request->hasFile('logo_en')) {
            $data['logo']['en'] = \App\Helpers\Image::upload($request->file('logo_en'), $this->path);
        }

        if ($request->hasFile('logo_ar')) {
            $data['logo']['ar'] = \App\Helpers\Image::upload($request->file('logo_ar'), $this->path);
        }
        $this->settingRepository->updateSetting($id, $data);

        return redirect()->route('admin.settings.index')
            ->with('message', __('admin.UpdatedMessage'));
    }
}
