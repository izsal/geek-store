<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //logout user
        auth()->logout();

        //invalidate session
        $request->session()->invalidate();

        //session regenerate
        $request->session()->regenerateToken();

        //redirect login page
        return redirect('/login');
    }
}
