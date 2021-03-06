<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }

    public function store()
    {
        // validate the request
        $attributes = request()->validate(
            [
                'email' => 'required|email',
                'password' => 'required'
            ]
        );

        // attempt to authenticate and log in the user
        // based on the provided credentials
        if (! Auth::attempt($attributes)) {
            throw ValidationException::withMessages(
                [
                    'email' => 'Your provided credentials could not be verified'
                    ]
            );
        }
        
        // auth failed
        // return back()
        //     ->withInput()
        //     ->withErrors(['email' => 'Your provided credentials could not be verified']);
        
        session()->regenerate();

        // redirect with a success flash message
        return redirect('/')->with('success', 'Welcome back');
    }


    public function destroy()
    {
        Auth::logout();

        return redirect('/')->with('success', 'Goodbye');
    }
}
