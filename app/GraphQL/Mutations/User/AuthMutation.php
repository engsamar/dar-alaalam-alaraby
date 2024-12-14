<?php

namespace App\GraphQL\Mutations\User;

use App\Models\User;
use App\Models\VerifyCode;
use Illuminate\Support\Arr;
use App\Models\User\UserDevice;
use Illuminate\Auth\AuthManager;
use App\Exceptions\CustomErrorHandler;
use Nuwave\Lighthouse\Exceptions\AuthenticationException;

final class AuthMutation
{
    public $error = 0;
    public $message = '';
    public $response;

    public function __construct(private AuthManager $authManager)
    {
        $this->authManager = $authManager;

    }

    public function login($_, array $args)
    {
        $userProvider = $this->authManager->createUserProvider('users');

        $user = $userProvider->retrieveByCredentials([
            'mobile'    => $args['mobile'],
            'password' => $args['password'],

        ]);

        if (!$user || !$userProvider->validateCredentials($user, $args)) {
            throw new CustomErrorHandler(
                __('messages.CredentialsWrong'),
                true,
                'FAIL',
                false,
                500 //not found
            );
        }

        if($user->active != 1) {
            throw new CustomErrorHandler(
                __('messages.AccountNotVerified'),
                true,
                'FAIL',
                false,
                500 //not found
            );

        }
        return [
            'token' => $user->createToken('login')->plainTextToken,
            'result' => [
                'status'=> 'SUCCESS',
                'error'=> false,
                'code' => 200,
                'message' => __('messages.LoginSuccess'),
            ]

        ];
    }



    public function register($_, array $args)
    {
        $userProvider = $this->authManager->createUserProvider();
        $args['active'] = 0;
        $user = User::create($this->getPropertiesFromArgs($args));
        //VerifyCode
        $data['code'] = mt_rand(100000, 999999);
        $data['mobile'] = $args['mobile'];
        // Create a new code
        $codeData = VerifyCode::create($data);
        return [
            'status'=> 'SUCCESS',
            'error'=> false,
            'code' => 200,
            'message' => __('messages.AccountCreated').' code: '.$data['code'],
        ];

    }


    public function changeLanguage($_, array $args)
    {
        $user = auth()->user();
        if(! $user){
            throw new AuthenticationException('Unauthenticated.', [[], 'sanctum']);
        }
        $user = User::where('id', $user->id)
            ->update(['lang' => $args['lang']]);

        return [
            'status'=> 'SUCCESS',
            'error'=> false,
            'code' => 200,
            'message' => __('messages.AccountUpdated'),
        ];

    }

    public function updateProfile($_, array $args)
    {
        $user = auth()->user();
        if(! $user){
            throw new AuthenticationException('Unauthenticated.', [[], 'sanctum']);
        }
        
        if(isset($args['mobile']) && ($user->mobile != $args['mobile']))
        {
            User::where('id', $user->id)->update(['active' => 0]);
        }

        User::where('id', $user->id)->update(
            [
                'name' => $args['name'] ?? $user->name ,
                'email' => $args['email'] ?? $user->email,
                'mobile' => $args['mobile'] ?? $user->mobile,
                'gender' => $args['gender'] ?? $user->gender,
                'image' => $args['image'] ?? $user->image,
                'birth_date' => $args['birth_date'] ?? $user->birth_date,
            ]
        );

        return [
            'status'=> 'SUCCESS',
            'error'=> false,
            'code' => 200,
            'message' => __('messages.AccountUpdated'),
        ];

    }

    public function updateFcmToken($_, array $args)
    {
        $user = auth()->user();
        if(! $user){
            throw new AuthenticationException('Unauthenticated.', [[], 'sanctum']);
        }
        UserDevice::updateOrCreate(
            [
                'device_id' => $args['device_id'],
                'user_id' => auth()->user()->id
            ],
            [
                'user_id' => auth()->user()->id,
                'device_id' => $args['device_id'],
                'status' => 1,
                'lang' => $user->lang ?? 'ar',
                'fcm_token' => $args['fcm_token'] ?? '',
                'version' => $args['version'] ?? '',
                'platform' => $args['platform'] ?? '',
            ]
        );

        return [

                'status'=> 'SUCCESS',
                'error'=> false,
                'code' => 200,
                'message' => __('messages.AccountUpdated'),
        ];

    }

    protected function getPropertiesFromArgs(array $args): array
    {
        $properties = Arr::except($args, ['directive', 'password_confirmation', 'verification_url']);
        // $properties['password'] = $this->hash->make($properties['password']);
        return $properties;
    }

}
