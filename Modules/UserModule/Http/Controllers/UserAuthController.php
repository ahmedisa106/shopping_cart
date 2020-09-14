<?php

namespace Modules\UserModule\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\UserModule\Entities\User;

class UserAuthController extends Controller
{
    public function doRegister(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed',
        ]);

        $data = $request->except(['_token', 'password']);

        $data['password'] = bcrypt($request->password);

        User::create($data);

        return redirect()->route('login');
    }

    public function doLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $remember = $request->has('rememmber') ? 1 : 0;

        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            return redirect('/');
        } else {
            return redirect()->back();
        }


    }

    public function logout()
    {

        Auth::logout();

        return redirect()->back();


    }
}
