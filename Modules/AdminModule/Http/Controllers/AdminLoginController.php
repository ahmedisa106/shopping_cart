<?php

namespace Modules\AdminModule\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AdminLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    public function loginForm()
    {

        return view('adminmodule::admin_login.login');

    }

    public function AdminLogin(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $rememberme = $request->has('rememberToken') ? '1' : '0';


        if (auth()->guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $rememberme)) {

            return redirect()->intended('/admin-panel');


        } else {
            return redirect()->back()->withErrors(['error' => 'Email or password is wrong.']);
        }


    }

    public function AdminLogout()
    {

        auth()->guard('admin')->logout();

        return redirect()->route('loginForm');

    }
}
