<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserMiddleware
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
        if (Auth::check())
            { 
                
                if(Auth::user()->isban == 1){
                    Auth::logout();
                    $message = 'Your account has been Banned. Please contact administrator.';
                    return redirect()->route('login') 
                        ->with('status',$message) 
                        ->withErrors(['email' => 'Your account has been Banned. Please contact administrator.']);
                 
                }
            } 
        return $next($request);
    }
}
