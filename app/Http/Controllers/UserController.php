<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * This function show user registration form
     */
    public function create() {
        return view('users.create');
    }

    /**
     * This function show login form
     */
    public function login() {
        return view('users.login');
    }

    /**
     * This function store user and login
     */
    public function store(Request $request) {
        $formFields = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:6', 'confirmed']
        ]);

         // Hash password
         $formFields['password'] = bcrypt($formFields['password']);

        $user = User::create($formFields);

        auth()->login($user);
        return redirect('/')->with('message', 'You are registered. Wellcome ' . auth()->user()->name);
    }

    /**
     * This function logout user
     */
    public function logout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You are logout');
    }

    /**
     * This function authenticate user
     */
    public function authenticate(Request $request) {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if(auth()->attempt($formFields)) {
            $request->session()->regenerate();

            // if user was redirected to login page for access let him go where he wants after login (if he has access User/Admin)
            if(session()->has('url.intended')) {
                return redirect(session('url.intended'));
            } else {
                // if user goes on login page on his own send him to home after login
                return redirect('/')->with('message', 'Wellcome '. auth()->user()->name);
            }
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }
}
