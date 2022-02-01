<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAuthenticated
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
        if( Auth::check() )
        {
//            // if user admin take him to his dashboard
//            if ( Auth::user()->isAdmin() ) {
//                return redirect(route('adminPage'));
//            }
//
//            // allow user to proceed with request
//            else if ( Auth::user()->isUser() ) {
//                return $next($request);
//            }
            if (Auth::check() && Auth::user()->role == "user" ) {
                return $next($request);
            }
            else {
                return redirect()->route('home');
//                ->with('error', "You don't have admin access.");
            }

        }
        return redirect("login")->withSuccess('You are not allowed to access');
    }
}
