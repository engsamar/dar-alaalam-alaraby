<?php

namespace App\GraphQL\Mutations\User;

use App\Models\User;
use Illuminate\Auth\AuthManager;
use App\Models\VerifyCode;

final class VerifyAccount
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
        $user = User::firstWhere('mobile', $args['mobile']);
        if($user && $user->active == 1){
            return [
                'error' => $this->error,
                'message' => trans('messages.user_active_before'),
                'status' => 'FAIL',
            ];

        }
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
            'message' => trans('messages.verify_code_sent').' code: '.$data['code'] ,
        ];
    }

    public function validate($_, array $args)
    {
        $verifyCode = VerifyCode::firstWhere('code', $args['code']);

        // check if it does not expired: the time is one hour
        if ($verifyCode->expired_at > now()->addHour()) {
            $verifyCode->delete();
            $this->error = 1;
            return [
                'error' => $this->error,
                'message' => trans('passwords.code_is_expire'),
                'status' => 'FAIL',
            ];
        }

        $user = User::firstWhere('mobile', $verifyCode->mobile);

        // update user active
        $user->update(['active' => 1]);

        $verifyCode->delete();

        return [
            'error' => $this->error,
            'status' => 'SUCCESS',
            'message' => trans('messages.AccountVerified')
        ];

    }


}
