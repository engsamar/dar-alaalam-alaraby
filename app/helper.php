<?php
    function dateFormatted($date ,$format = 'M d, Y' , $showTimes = false)
    {
        if ($showTimes) {
            $format = $format . ' @ h:i a';
        }

        return date($format, strtotime($date));
    }


    function imagePath($value)
    {
        if ($value != '') {
            return asset($value);
        } else {
            return asset('/no-pictures.png');
        }
    }


    function uniqueCode($model, $attribute)
    {
        $uniqueStr = '';
        $uniqueStr = rand(100000000, 900000000);
        while ($model::where($attribute, $uniqueStr)->exists()) {
            $uniqueStr = rand(100000000, 900000000);
        }
        //str_pad(time(), 8, "0", STR_PAD_LEFT)
        return $uniqueStr;
    }


    function uniqueStringCode($model, $attribute,$number=8)
    {
        $uniqueStr = '';
        $bytes = random_bytes($number);
        $uniqueStr = bin2hex($bytes);
        while ($model::where($attribute, $uniqueStr)->exists()) {
            $uniqueStr = bin2hex($bytes);
        }
        //str_pad(time(), 8, "0", STR_PAD_LEFT)
        return $uniqueStr;
    }
