<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CountryInputCodeRule implements Rule
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
        /////// check if all chars in value are capitalized
        return ctype_upper($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Nationality Or Country Values Must Be Uppercase Characters Of Country Code.';
    }
}
