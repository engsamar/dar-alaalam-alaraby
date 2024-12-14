<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class ActiveUser implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public $context;
    public $message;

    public function __construct($context)
    {
        //
        $this->context = $context;
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
        $user = User::where('email', $value)->first();
        if (is_null($user)) {
            $this->message  = __("auth.The_provided_credentials_are_incorrect");
                 return $this->context === 'register' ? true : false;
        } else {
                $this->message  = $this->context === 'register' ? __('auth.register_with_non_active_user')
                : __('auth.login_with_non_active_user');
                return $user->active;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {



        return $this->message;
    }
}