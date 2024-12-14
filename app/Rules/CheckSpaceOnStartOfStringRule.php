<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckSpaceOnStartOfStringRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //regx  for not  starting with space
        $re = '/^[^\s].*[^\s]$/m';
        $valid = false;
        if (preg_match_all($re, $value, $matches, PREG_SET_ORDER, 0) == 1) {
            $valid = true;
        }

        return $valid;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Make Sure Values Shouldn\'t Start With Space';
    }
}
