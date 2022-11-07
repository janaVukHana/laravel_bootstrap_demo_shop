<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // if user is logged
        if(Auth::check()) {
            if(Auth::user()->role == '1') {
                // Admin can access to all pages
                return $next($request);
            } else {
                // Regular user will be redirected to home page
                return redirect('/')->with('message', 'You dont have admin permissions');
            }
        }
        // if user is NOT logged: Guest will be redirected to login page
        return view('users.login')->with('message', 'You must login first');
    }
}
