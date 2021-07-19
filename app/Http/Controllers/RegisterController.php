<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register.create');
    }

    public function store(Request $request)
    {
        //create the user
        $attributes = request()->validate(
            [
                'name' => 'required|min:3',
                'username' => 'required|max:255|min:3|unique:users,username',
                'email' => 'required|email|max:255|unique:users,email',
                'password' => 'required|max:255|min:7'
            ]
        );

        $user = User::create($attributes);

        // Log the user in

        Auth::login($user);

        //session()->flash('success', 'Your account has been created');

        return redirect('/')->with('success', 'Your account has been created');
    }
}
