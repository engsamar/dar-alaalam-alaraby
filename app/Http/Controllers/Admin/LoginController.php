<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{

    public function __construct(
    ) {
    }

    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function postLogin(LoginRequest $request)
    {
        $user = auth()->guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], 1);
        if ($user) {
            return redirect()->route('admin.home');
        }

        return back()->withErrors(['message' => 'E-mail or password is wrong'])->withInput($request->only('email', 'remember'));
    }

    public function logout()
    {
        auth()->guard('admin')->logout();

        return redirect()->route('admin.home');
    }

    public function home()
    {
        $result = [];
        return view('admin.home', compact('result'));
    }
}