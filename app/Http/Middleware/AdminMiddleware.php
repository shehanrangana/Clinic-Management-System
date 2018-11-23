<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class AdminMiddleware
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
        if (!\Auth::check() || $request->user() && $request->user()->user_role != 0){
            return back();
            //dd(\Auth::check());
        }
        return $next($request);
    }
}
