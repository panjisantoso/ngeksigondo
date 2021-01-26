<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class IsUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()){
            if (auth()->user()->is_admin == 1) {
                return redirect()->route('loginHome');
            } else {
                return redirect()->route('home');
            }
        } 
        else {
            return $next($request);
        }        
    }
}
