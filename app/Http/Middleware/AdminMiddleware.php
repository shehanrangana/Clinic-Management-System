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
        if (\Auth::check() && $request->user() && $request->user()->user_role == 0){
            return $next($request);
        }else if(\Auth::check() && $request->user() && $request->user()->user_role == 1){ // Also receptionist can manage patients table
            if($request->is(['admin/patients/show', 'admin/patients/remove/*'])){
                return $next($request);
            }
        }else{
            return back();
        }  
    }
}
