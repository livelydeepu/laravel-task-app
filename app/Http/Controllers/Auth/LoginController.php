<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Handle the login request.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        return view('auth.login');
    }

    /**
     * Validate the login credential
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $auth_login_user = auth()->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ], $request->password);

        if($auth_login_user)
        {
            return redirect()->route('dashboard')->with('success', 'Login Successfully');
        }
        else
        {
            return redirect()->back()->with('error', 'Incorrect Credential');
        }
    }
}
