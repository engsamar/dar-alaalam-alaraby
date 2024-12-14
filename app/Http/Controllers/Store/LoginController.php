<?php

namespace App\Http\Controllers\Store;

use App\Models\Store\Store;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{

    public function __construct(
    ) {
    }

    public function showLoginForm()
    {
        return view('store.login');
    }

    public function postLogin(LoginRequest $request)
    {
        $user = auth()->guard('store')->attempt(['email' => $request->email, 'password' => $request->password], 1);
        if ($user) {
            return redirect()->route('store.home');
        }

        return back()->withErrors(['message' => 'E-mail or password is wrong'])->withInput($request->only('email', 'remember'));
    }

    public function logout()
    {
        auth()->guard('store')->logout();

        return redirect()->route('store.home');
    }

    public function home()
    {
        $result = [];
        return view('store.home', compact('result'));
    }
}
