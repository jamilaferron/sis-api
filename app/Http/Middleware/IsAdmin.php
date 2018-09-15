<?php

namespace App\Http\Middleware;

use Closure;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

            if(auth()->check() && $request->user()->role == 'superAdmin')
            {

                    return redirect()->guest('/');
                
            }
            if(auth()->check() && $request->user()->role == 'manager')
            {
                return redirect()->guest('/');
            }
            if(auth()->check() && $request->user()->role == 'support worker')
            {
                return redirect()->guest('/');
            }
            return $next($request);

        
    }
}
