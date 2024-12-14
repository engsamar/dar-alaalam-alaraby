<?php

namespace App\GraphQL\Mutations;

final class Upload
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        /** @var \Illuminate\Http\UploadedFile $file */
        $file = $args['file'];
        return \App\Helpers\Image::upload($file, 'users');
        // return $file->storePublicly('uploads');
    }
}