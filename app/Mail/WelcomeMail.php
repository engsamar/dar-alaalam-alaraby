<?php

namespace App\Mail;

use App\Models\AppSetting\AppSetting;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    // public $setting;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        //
        // $setting = AppSetting::first();
        $this->user = $user;
        // $this->setting = $setting;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user = $this->user;
        // $setting = $this->setting;

        return $this->view('emails.welcome', compact('user'))->subject(__('messages.welcomeEmailTitle'));
    }
}