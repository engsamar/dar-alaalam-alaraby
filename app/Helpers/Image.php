<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class Image
{
    public static function upload($file, $path)
    {
        $name = '';
        if ($file) {
            $image = $file;
            $imageName = time() . $image->hashName();
            $file->move(public_path('images/'.$path), $imageName);
            $name = 'images/'.$path.'/' . $imageName;
        }
        return $name;
    }

    public static function uploadToPublic($file, $path)
    {
        $name = '';
        if ($file) {
            $image = $file;
            Storage::disk('public')->put('images/'.$path, $file);
            $name = 'images/'.$path.'/' . $image->hashName();
        }
        return $name;
    }
}
