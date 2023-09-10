<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        return inertia('Auth/Register');
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        //set validation
        $request->validate([
            'name'      => 'required',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|confirmed'
        ]);

        //insert data user
        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => bcrypt($request->password)
        ]);

        //find role "customer"
        $role = Role::findByName('customer');

        //assign role "customer" to user
        $user->assignRole($role);

        //redirect to login
        return redirect()->route('login');
    }
}
