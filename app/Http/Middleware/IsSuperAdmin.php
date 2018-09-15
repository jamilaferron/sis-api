<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class IsSuperAdmin
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

            if (auth()->check() && $request->user()->role == 'support' || $request->user()->role == 'admin' || $request->user()->role == 'manager') {
                return redirect()->guest('/');
            }
            return $next($request);
        
    }
}
