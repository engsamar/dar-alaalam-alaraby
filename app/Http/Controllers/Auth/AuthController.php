<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Product\Cart;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Http\Requests\WebLoginRequest;
use Illuminate\Support\Facades\Cookie;
use App\Interfaces\ContentRepositoryInterface;

class AuthController extends Controller
{
    private $__path = 'users';
    private $__model = 'App\Models\City';
    private ContentRepositoryInterface $__contentRepository;

    public function __construct(
        ContentRepositoryInterface $__contentRepository
    ) {
        $this->__contentRepository = $__contentRepository;
    }
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        $result = [];
        return view('auth.register', compact('result'));
    }

    public function verifyAccount()
    {
        $user = auth()->user();
        return view('auth.verify-account', compact('user'));
    }


    public function postLogin($locale, WebLoginRequest $request)
    {
        $user = auth()->attempt(['mobile' => $request->full, 'password' => $request->password], 1);
        if ($user) {

            toastr()->success(__('message.LoginSuccessfully'));

            $carts = Cart::whereHas('product', function ($q) {
                $q->publish();
            })->where('device', Cookie::get('cart_device'))->get();

            if (!empty($carts)) {
                foreach ($carts as $item) {
                    Cart::where('product_id', $item->product_id)
                        ->where('user_id', auth()->user()->id)->update(['quantity' => $item->quantity]);
                    $item->update(['user_id' => auth()->user()->id]);
                }
            }

            return redirect()->route('website.home', ['locale' => $locale]);
        }
        toastr()->error(__('message.wrongLoginCredential'));

        return back()
            ->withErrors(['message' => __('message.wrongLoginCredential')])
            ->withInput($request->only('email', 'remember'));
    }

    public function logout($locale)
    {
        auth()->logout();

        return redirect()->route('website.home', ['locale' => $locale]);
    }

    public function postRegister($locale, CustomerRequest $request)
    {
        $data = $request->all();
        $data['mobile'] = $data['full'];
        $user = User::create($data);
        auth()->login($user);
        toastr()->success(__('message.RegisterSuccessfully'));
        return redirect()->route('website.home', ['locale' => $locale]);
    }
}
