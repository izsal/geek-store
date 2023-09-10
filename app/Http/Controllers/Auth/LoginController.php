<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //return inertia
        return inertia('Auth/Login');
    }

    public function store(Request $request)
    {
        //set validation
        $request->validate([
            'email'     => 'required|email',
            'password'  => 'required',
        ]);

        //get email and password from request
        $credentials = $request->only('email', 'password');

        //attempt to login
        if (auth()->attempt($credentials)) {

            //regenerate session
            $request->session()->regenerate();

            //redirect route dashboard
            return redirect()->route('account.dashboard');
        }

        //if login fails
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records',
        ]);
    }
}
