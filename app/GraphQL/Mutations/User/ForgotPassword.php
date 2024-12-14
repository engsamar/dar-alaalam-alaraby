<?php

namespace App\GraphQL\Mutations\User;

use App\Models\User;
use App\Models\VerifyCode;
use Illuminate\Auth\AuthManager;
use App\Mail\SendCodeResetPassword;
use Illuminate\Support\Facades\Mail;


final class ForgotPassword
{
    public $error = 0;
    public $message = '';
    public $response;

    public function __construct(private AuthManager $authManager)
    {
        $this->authManager = $authManager;
    }
    public function send($_, array $args)
    {
        //create code
        VerifyCode::where('mobile', $args['mobile'])->delete();

        // Generate random code
        $data['code'] = mt_rand(100000, 999999);
        $data['mobile'] = $args['mobile'];
        // Create a new code
        $codeData = VerifyCode::create($data);

        // Send mobile to user
        // Mail::to($args['mobile'])->send(new SendCodeResetPassword($codeData['code']));

        return [
            'error' => $this->error,
            'status' => 'SUCCESS',
            'message' => trans('passwords.sent').' '.$data['code'] ,
        ];
    }

    public function validate($_, array $args)
    {
        $passwordReset = VerifyCode::firstWhere('code', $args['code']);

        // check if it does not expired: the time is one hour
        if ($passwordReset->created_at > now()->addHour()) {
            $passwordReset->delete();
            $this->error = 1;
            return [
                'error' => $this->error,
                'message' => trans('passwords.code_is_expire'),
                'status' => 'FAIL',
            ];
        }

        return [
            'error' => $this->error,
            'status' => 'SUCCESS',
            'message' => trans('passwords.success')
        ];


    }

    public function confirm($_, array $args)
    {
        // find the code
        $passwordReset = VerifyCode::firstWhere('code', $args['code']);

        // check if it does not expired: the time is one hour
        if ($passwordReset->created_at > now()->addHour()) {
            $passwordReset->delete();
            $this->error = 1;
            return [
                'status' => 'FAIL',
                'error' => $this->error,
                'message' => trans('passwords.token')
            ];
        }

        // find user's mobile
        $user = User::firstWhere('mobile', $passwordReset->mobile);

        // update user password
        $user->update(['password' => $args['password']]);

        // delete current code
        $passwordReset->delete();

        return [
            'error' => $this->error,
            'status' => 'SUCCESS',
            'message' =>'password has been successfully reset'
        ];
    }

    //updatePassword

    public function updatePassword($_, array $args)
    {
        $user = auth()->user();

        if (app('hash')->check($args['old_password'], $user->password)) {
            $user->update(['password' => $args['password']]);
            return [
                'error' => $this->error,
                'status' => 'SUCCESS',
                'message' =>'password has been successfully reset'
            ];

        } else {
            $this->error =1;
            return [
                'error' => $this->error,
                'status' => 'FAIL',
                'message' =>'the old password is wrong'
            ];
        }
    }

}
