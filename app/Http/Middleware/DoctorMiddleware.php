<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class DoctorMiddleware
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
        if (!\Auth::check() || $request->user() && $request->user()->user_role != 2){
            return back();
            //return redirect()->guest('login');
        }
        return $next($request);
    }
}
