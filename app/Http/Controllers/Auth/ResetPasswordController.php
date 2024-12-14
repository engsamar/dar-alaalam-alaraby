<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Services\SMS;
use App\Models\VerifyCode;
use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use App\Interfaces\CRUDRepositoryInterface;
use App\Http\Requests\ForgotPasswordRequest;

class ResetPasswordController extends Controller
{
    private CRUDRepositoryInterface $__itemRepository;

    public function __construct(
        CRUDRepositoryInterface $__itemRepository
    ) {
        $this->__itemRepository = $__itemRepository;
    }
    public function show()
    {
        $result = [];
        return view('auth.forgot-password', compact('result'));
    }

    public function sendCode(ForgotPasswordRequest $request)
    {
        $args = $request->all();
        $user = User::firstWhere('mobile', $args['mobile']);
        //create code
        VerifyCode::where('mobile', $args['mobile'])->delete();

        // Generate random code
        $data['code'] = mt_rand(1000, 9999);
        $data['mobile'] = $args['mobile'];
        // Create a new code
        $codeData = VerifyCode::create($data);

        $result['mobile'] =  $args['mobile'];

        $message = "Verification Code: " . $data['code'];

        SMS::send($args['mobile'], $message);

        toastr()->success(__('titles.PasswordsSent', ['mobile' => substr($result['mobile'], -4)]));

        return view('auth.reset-password', compact('result'));
    }

    public function confirm(ResetPasswordRequest $request)
    {
        $args = $request->all();
        // find the code
        $passwordReset = VerifyCode::firstWhere('code', $args['code']);

        // check if it does not expired: the time is one hour
        if ($passwordReset->created_at > now()->addHour()) {
            $passwordReset->delete();
        }

        // find user's mobile
        $user = User::firstWhere('mobile', $passwordReset->mobile);

        // update user password
        $user->update(['password' => $args['password']]);

        // delete current code
        $passwordReset->delete();

        toastr()->success(__('titles.PasswordReset'));

        return redirect()->route('website.login');
    }
}
